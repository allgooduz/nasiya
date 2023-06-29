<?php

namespace App\Http\Controllers\UzCardApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Throwable;

class UzcardController extends Controller
{
    public $encodedAuthorization;
    public $headers;
    public $my_card_number;
    public $my_card_number_expiry;
    public $my_phone_number;
    public $otp;
    public $amount;

    public function __construct(Request $request)
    {
        $authorization = 'allgoodmarketplace:uM4e7UQ83g0J5K!^';
        $this->encodedAuthorization = base64_encode($authorization);

        $this->headers = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Authorization' => 'Basic ' . $this->encodedAuthorization,
            'Accept' => 'application/json',
            'Language' => 'ru'
        ];

        if (!empty($request->otp)) {
            $this->otp = $request->otp;
        }

        if (!empty($request->amount)) {
            $this->amount = $request->amount.".00";
        }

        $this->my_card_number = $request->card_number; 
        $this->my_card_number_expiry = $request->card_validation_date;
        $this->my_phone_number = $request->phone_number;
    }

    public function createUserCard()
    {
        $requested_card_number = str_replace(' ', '', $this->my_card_number);
        $requested_expiry_year_to_month = substr($this->my_card_number_expiry, strpos($this->my_card_number_expiry, "/") + 1);
        $requested_expiry_month_to_year = strtok($this->my_card_number_expiry, '/');
        $requested_expiry = $requested_expiry_year_to_month.$requested_expiry_month_to_year;

        if (empty($this->otp)) {
            $body = [
                'userId' => uniqid(), // later change user id to dynamic
                'cardNumber' => $requested_card_number,
                'expireDate' => $requested_expiry,
                'userPhone' => $this->my_phone_number,
            ];
    
            $response = Http::withHeaders($this->headers)->post('https://pay.myuzcard.uz/api/UserCard/createUserCard', $body);
            $response = $response->body();
            $data = json_decode($response);
            
            if (isset($data->error->errorCode) && $data->error->errorCode == -108) {

                $body = [
                    'userId' => '101', // later change user id to dynamic
                ];
                
                $response = Http::withHeaders($this->headers)->get('https://pay.myuzcard.uz/api/UserCard/getAllUserCards', $body);
                $response = $response->body();
                $data = json_decode($response);

                return $this->createScoringCard($data->result->cards[0]->cardId);
            }
            if (isset($data->error->errorCode)) {
                return redirect()->back()->with([
                    "successCard" => $this->my_card_number, 
                    "successCardExpiry" => $this->my_card_number_expiry, 
                    "successPhoneNumber" => $this->my_phone_number,
                    'errorCode'=>$data->error->errorCode, 
                    'errorMessage'=>$data->error->errorMessage
                ]);
            }
            Session::put('mySession', $data->result->session);

            return redirect()->back()->with(["askOtp" => "Введите пароль", "successCard" => $this->my_card_number, "successCardExpiry" => $this->my_card_number_expiry, "successPhoneNumber" => $this->my_phone_number, "successAmount" => $this->amount]);
        }

        return $this->confirmCreatedUserCard();
    }

    public function confirmCreatedUserCard()
    {
        $body = [
            'session' => Session::get('mySession'),
            'otp' => $this->otp,
        ];

        $response = Http::withHeaders($this->headers)->post('https://pay.myuzcard.uz/api/UserCard/confirmUserCardCreate', $body);
        $response = $response->body();
        $data = json_decode($response);

        if (isset($data->error->errorCode)) {
            return redirect()->back()->with([
                "successCard" => $this->my_card_number, 
                "successCardExpiry" => $this->my_card_number_expiry, 
                "successPhoneNumber" => $this->my_phone_number,
                'errorCode'=>$data->error->errorCode, 
                'errorMessage'=>$data->error->errorMessage
            ]);
        }

        $firstFourDigits = substr($this->my_card_number, 0, 4);
        if ($firstFourDigits == "9860") {
            // HUMO 
            return $this->createScoringCardHUMO($data->result->card->cardId);
        } else {
            // UZCARD
            return $this->createScoringCard($data->result->card->cardId);
        }
    }

    // HUMO
    public function createScoringCardHUMO($cardId)
    {
        $body = [
            'cardId' => $cardId,
            'startDate' => "2022-07-08",
            'endDate' => "2023-06-08",
        ];

        $response = Http::withHeaders($this->headers)->post('https://pay.myuzcard.uz/api/Scoring/HumoScoring', $body);
        $response = $response->body();
        $data = json_decode($response); 

        if (isset($data->error->errorCode)) {
            return redirect()->back()->with([
                "successCard" => $this->my_card_number, 
                "successCardExpiry" => $this->my_card_number_expiry, 
                "successPhoneNumber" => $this->my_phone_number,
                'errorCode'=>$data->error->errorCode, 
                'errorMessage'=>$data->error->errorMessage
            ]);
        }
        
        return redirect()->back()->with([
            "successCard" => $this->my_card_number, 
            "successCardExpiry" => $this->my_card_number_expiry, 
            "successPhoneNumber" => $this->my_phone_number,
            "result" => "200",
            "resultFrom" => "HUMO",
            "listPoint" => $data->result->report
        ]);

        // return $this->createScoringAmount($cardId, $data->result->scoringId);
        // return $this->scoringGetPoint($data->result->scoringId);
    }

    public function createScoringCard($cardId)
    {
        $body = [
            'cardId' => $cardId,
            'templateId' => 47,
            'beginDate' => "2022-07-08",
            'endDate' => "2023-06-08",
        ];

        $response = Http::withHeaders($this->headers)->post('https://pay.myuzcard.uz/api/Scoring/createScoringCard', $body);
        $response = $response->body();
        $data = json_decode($response); 

        if (isset($data->error->errorCode)) {
            return redirect()->back()->with([
                "successCard" => $this->my_card_number, 
                "successCardExpiry" => $this->my_card_number_expiry, 
                "successPhoneNumber" => $this->my_phone_number,
                'errorCode'=>$data->error->errorCode, 
                'errorMessage'=>$data->error->errorMessage
            ]);
        }
        
        // return $this->createScoringAmount($cardId, $data->result->scoringId);
        return $this->scoringGetPoint($data->result->scoringId);
    }

    public function createScoringAmount($cardId, $scoringId)
    {
        $body = [
            'cardId' => $cardId,
            'templateId' => 47,
            'amount' => $this->amount,
            'beginDate' => "2023-01-14",
            'endDate' => "2023-07-14",
        ];

        $response = Http::withHeaders($this->headers)->post('https://pay.myuzcard.uz/api/Scoring/createScoringAmount', $body);
        $response = $response->body();
        $data = json_decode($response);

        // return $this->ScoringGetMonth($data->result->scoringId);
        return $this->scoringGetPoint($data->result->scoringId);
    }

    public function ScoringGetMonth($scoringId)
    {
        $body = [
            'scoringId' => $scoringId,
        ];

        $response = Http::withHeaders($this->headers)->get('https://pay.myuzcard.uz/api/Scoring/scoringGetMonth', $body);
        $response = $response->body();
        $data = json_decode($response);

        $box = [];
        $positive = 0;
        $negative = 0;
        foreach ($data->result->values as $key => $value) {
            if ($value == "true") {
                $positive++;
            }else{
                $negative++;
            }
        }

        $answer = '';

        if ($positive > $negative) {
            $answer = "Congratulations! Your scoring result is successfull!";
            $answerColor = "success";
        }else{
            $answer = "Unfortunately, we can't confirm it...";
            $answerColor = "danger";
        }

        return redirect()->back()->with(['answer' => $answer, 'positive' => $positive, 'negative' => $negative, 'answerColor' => $answerColor,]);
    }

    public function scoringGetPoint($scoringId)
    {
        $body = [
            'scoringId' => $scoringId,
        ];

        $response = Http::withHeaders($this->headers)->get('https://pay.myuzcard.uz/api/Scoring/scoringGetPoint', $body);
        $response = $response->body();
        $data = json_decode($response);

        return redirect()->back()->with([
            "successCard" => $this->my_card_number, 
            "successCardExpiry" => $this->my_card_number_expiry, 
            "successPhoneNumber" => $this->my_phone_number,
            "result" => "200",
            "resultFrom" => "UZCARD",
            "maxPoint" => $data->result->maxScoreBall,
            "clientsPoint" => $data->result->scoredBall,
            "listPoint" => $data->result->scoreList
        ]);

        // return $this->ScoringGetMonth($data->result->scoringId);
    }











    // DELETE FUNCTION
    public function deleteUserCard()
    {
        $body = [
            'userCardId' => 1571585,
        ];

        $response = Http::withHeaders($this->headers)->delete('https://pay.myuzcard.uz/api/UserCard/deleteUserCard?userCardId=1571585', $body);
        $response = $response->body();
        $data = json_decode($response);
        dd($data);
        return response()->json($response);
    }
}