<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Str;
use DateTime;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

class Helper
{
    public static function IDGenerator($model, $trow, $prefix, $length = 4)
    {
        $data = $model::orderBy('id', 'desc')->first();
        if (!$data) {
            $og_length = $length;
            $last_number = '';
        } else {
            $code = substr($data->$trow, strlen($prefix) + 1);
            $actial_last_number = ($code / 1) * 1;
            $increment_last_number = ((int)$actial_last_number) + 1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for ($i = 0; $i < $og_length; $i++) {
            $zeros .= "0";
        }
        return $prefix . '-' . $zeros . $last_number;
    }

    public static function SlugGenerator($string)
    {
        return Str::snake($string);
    }

    public static function FormatDate($inputDate)
    {
        if (!$inputDate) {
            return '';
        }

        try {
            $dateTime = new DateTime($inputDate);
            return $dateTime->format('F j, Y');
        } catch (\Throwable $th) {
            return $inputDate;
        }
    }

    public static function FormatNumber($amount)
    {
        return number_format($amount, 2);
    }

    public static function FormatDateTime($inputDateTime)
    {
        if (!$inputDateTime) {
            return '';
        }

        try {
            $dateTime = new DateTime($inputDateTime);
            $timeFormat = $dateTime->format('i') == '00' ? 'GA' : 'g:ia';
            return $dateTime->format('F j, Y ' . $timeFormat);
        } catch (\Throwable $th) {
            return $inputDateTime;
        }
    }

    public static function SuccessResponse($message, $data = [], $token = null, $statusCode)
    {
        $responseData = [
            'success' => true,
            'status' => ResponseStatuses::SUCCESS,
            "message" => $message,
            "data" => $data,
        ];

        if ($token) {
            $responseData['token'] = $token;
        }

        return response()->json($responseData, $statusCode);
    }

    public static function ErrorResponse($message, $data = [], $statusCode)
    {
        return response()->json([
            'success' => false,
            'status' => ResponseStatuses::ERROR,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    // 
    public static function UploadFile($applicant, $file, $destinationPath)
    {
        $file_name = $applicant . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $file_name);
        return $file_name;
    }

    public static function LogActivity($user, $action, $description)
    {
        ActivityLog::create([
            'user' => $user,
            // 'email' => $email,
            'action' => $action,
            'description' => $description,
            'ip_address' => Request::ip(),
            'browser' => Request::userAgent(),
        ]);
    }

    // 
    public static function PrettifyJson(array $data)
    {

        // Format JSON for better readability
        $formattedJson = json_encode($data, JSON_PRETTY_PRINT);

        // Remove curly braces
        $formattedJson = str_replace(['{', '}'], '', $formattedJson);

        return nl2br($formattedJson);
    }
}
