<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{Enquiry,Trip};
class SiteTest extends TestCase {
 use RefreshDatabase;
 public function test_homepage_loads():void{$this->get('/')->assertOk()->assertSee('Trails worth');}
 public function test_tour_list_loads():void{$this->get('/tours')->assertOk()->assertSee('Find your kind');}
 public function test_posted_enquiry_is_persisted():void{
  $res=$this->from('/contact')->post('/enquiry',['name'=>'Test Traveler','phone'=>'9876543210','group_size'=>2,'message'=>'I am interested','consent'=>1,'company_website'=>'']);
  $res->assertRedirect('/contact'); $this->assertDatabaseHas('enquiries',['name'=>'Test Traveler','status'=>'new']);
 }
 public function test_invalid_enquiry_rejected():void{
  $this->from('/contact')->post('/enquiry',['name'=>'X','phone'=>'bad','group_size'=>0])->assertSessionHasErrors();
  $this->assertSame(0,Enquiry::count());
 }
 public function test_sitemap_loads():void{$this->get('/sitemap.xml')->assertOk()->assertHeader('Content-Type','application/xml; charset=utf-8');}
}
