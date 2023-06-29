<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Helper
{

    public static function formatNumber($number)
    {
        return number_format($number, 0, '.', ' ');
    }

    public static function formatPrice($number)
    {
        return self::formatNumber($number) . ' ' . __('main.currency');
    }

    public static function formatPriceWithoutCurrency($number)
    {
        return self::formatNumber($number) . ' UZS';
    }

    public static function formatDate(Carbon $date, $year = false)
    {
        $yearFormat = ($year) ? ', Y' : '';
        return __($date->format('F')) . ' ' . $date->format('d' . $yearFormat);
    }

    public static function formatDateSecond(Carbon $date)
    {
        return '<div>' . $date->format('d') . '</div><div>' . __($date->format('F')) . '</div>';
    }

    public static function reformatPhone($phone)
    {
        $phone = preg_replace('#[^\d]#', '', $phone);
        if (mb_strlen($phone) == 9) {
            $phone = '998' . $phone;
        }
        return $phone;
    }

    public static function storeFile($model, $field, $dir, $isImage = false)
    {
        if (request()->has($field)) {
            $url = request()->$field->store($dir . '/' . date('FY'), 'public');
            if (!$isImage) {
                $url = json_encode([
                    [
                        'download_link' => $url,
                        'original_name' => request()->$field->getClientOriginalName(),
                    ]
                ]);
            }
            $model->$field = $url;
            $model->save();
        }
        return $model;
    }

    public static function storeImage($model, $field, $dir, $thumbs = [])
    {
        $model = self::storeFile($model, $field, $dir, true);
        if ($thumbs && $model->$field) {
            $image = Image::make(storage_path('app/public/' . $model->$field));
            $image->backup();
            if ($image) {
                $ext = mb_strrchr($model->$field, '.');
                $pos = mb_strrpos($model->$field, '.');
                $fileName = mb_substr($model->$field, 0, $pos);
                foreach ($thumbs as $key => $value) {
                    $image->fit($value[0], $value[1])->save(storage_path('app/public/' . $fileName . '-' . $key . $ext));
                    $image->reset();
                }
            }
        }
        return $model;
    }

    public static function storeImages( $requestImages, $model, $field, $dir, $thumbs = [])
    {
        $fieldValues = [];
        foreach ($requestImages as $url) {
            // no extension
            /*if (strpos($name, '.') === false) {
                continue;
            }*/
            // save file

            $fieldValue = $dir . '/' . date('FY') . '/' . $model->id;
            $go = $url->store($fieldValue, 'public');

            $mime = mime_content_type(Storage::disk('public')->path($go));
            if (!in_array($mime, ['image/jpeg', 'image/png', 'image/gif'])) {
                Storage::disk('public')->delete($go);
                continue;
            }
            $fieldValues[] = $go;
        }

        $model->$field = json_encode($fieldValues);
        $model->save();

        if ($thumbs && !empty($model->$field) && $model->$field != '[]') {
            $modelImages = json_decode($model->$field);
            foreach ($modelImages as $modelImage) {
                $image = Image::make(storage_path('app/public/' . $modelImage));
                $image->backup();
                if ($image) {
                    $ext = mb_strrchr($modelImage, '.');
                    $pos = mb_strrpos($modelImage, '.');
                    $fileName = mb_substr($modelImage, 0, $pos);
                    foreach ($thumbs as $key => $value) {
                        $image->fit($value[0], $value[1])->save(storage_path('app/public/' . $fileName . '-' . $key . $ext));
                        $image->reset();
                    }
                }
            }
        }
        return $model;
    }
}
