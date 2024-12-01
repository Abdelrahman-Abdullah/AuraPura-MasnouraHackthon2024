<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


if (!function_exists('handleAttachmentUploading')) {
    /**
     * @throws Exception
     */
    function handleAttachmentUploading($file, $folder = 'avatars'): string
    {
        try {
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs($folder, $file, $fileName);
            return $folder . '/' . $fileName;

        } catch (\Exception $e) {
            logError('Avatar upload failed', $e);
            throw new \Exception('Attachment uploading failed');
        }

    }
}

if (!function_exists('logError')) {
    function logError($message, \Exception $e): void
    {
        Log::error($message . ': ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'code' => $e->getCode()
        ]);
    }

}
