<?php
namespace App\Support\Velho;

trait FileUpload
{

    public static function upload($path, $field = 'image', callable $callback = null)
    {
        $filename = request()->file($field)->store($path, 'public');

        $preview = asset('storage/' . $filename);

        if ($callback) {
            $callback($filename);
        }

        return [
            'preview' => $preview,
            'name' => $filename
        ];
    }

    public function fileUrl($field = 'image', $default = null)
    {
        $image = $this->attributes[$field] ?? null;
        if ($image !== null
            && !empty($image)) {
            if (filter_var($image, FILTER_VALIDATE_URL)) {
                return $image;
            } else {
                return asset('storage/' . $image);
            }
        }

        return $default;
    }

}
