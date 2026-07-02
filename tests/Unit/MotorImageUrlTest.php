<?php

namespace Tests\Unit;

use App\Models\Motor;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MotorImageUrlTest extends TestCase
{
    public function test_public_asset_motor_images_resolve_to_asset_urls(): void
    {
        $motor = new Motor(['image_path' => 'assets/motors/honda-beat-main-gallery-transparent.png']);

        $this->assertSame(asset('assets/motors/honda-beat-main-gallery-transparent.png'), $motor->image_url);
    }

    public function test_uploaded_motor_images_resolve_to_public_storage_urls(): void
    {
        $motor = new Motor(['image_path' => 'motors/uploaded.png']);

        $this->assertSame(Storage::disk('public')->url('motors/uploaded.png'), $motor->image_url);
    }
}
