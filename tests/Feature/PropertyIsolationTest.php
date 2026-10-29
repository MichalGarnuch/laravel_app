<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
class PropertyIsolationTest extends TestCase
{
 use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        config(['app.key'=>'base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=']); // Test-only key.
        $this->withoutVite();
    }

 public function test_a_user_cannot_read_another_users_property(): void {
  $a=User::factory()->create(); $b=User::factory()->create();
  $property=Property::create(['user_id'=>$a->id,'name'=>'private','address'=>'x','area'=>10,'price'=>1]);
  $this->actingAs($b)->get(route('properties.show',$property))->assertForbidden();
  $this->actingAs($a)->get(route('properties.show',$property))->assertOk();
 }
}
