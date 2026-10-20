<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use RuntimeException;

class SeederImages
{
    private static ?array $images = null;

    public static function publish(): array
    {
        $sourceDirectory = base_path('gambar');

        if (! File::isDirectory($sourceDirectory)) {
            throw new RuntimeException('Seeder image directory not found: '.$sourceDirectory);
        }

        $images = collect(File::files($sourceDirectory))
            ->filter(fn ($file) => strtolower($file->getExtension()) === 'jpg')
            ->sortBy(fn ($file) => $file->getFilename())
            ->map(fn ($file) => $file->getFilename())
            ->values()
            ->all();

        if ($images === []) {
            throw new RuntimeException('No JPG images found in '.$sourceDirectory);
        }

        $destinationDirectory = public_path('gambar');
        File::ensureDirectoryExists($destinationDirectory);

        foreach ($images as $image) {
            File::copy($sourceDirectory.DIRECTORY_SEPARATOR.$image, $destinationDirectory.DIRECTORY_SEPARATOR.$image);
        }

        return self::$images = $images;
    }

    public static function urlForIndex(int $index): string
    {
        $images = self::$images ?? self::publish();

        return '/gambar/'.$images[$index % count($images)];
    }
}
