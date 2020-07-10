<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Negocio\Entities\Negocio;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Animal\Entities\Animal;

class AnimalApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_animal()
    {
        $animal = factory(Animal::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/animal/animales', $animal
        )->assertStatus(201);

    }

    /**
     * @test
     */
    public function test_list_animales()
    {
        factory(Animal::class,10)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/animal/animales/'
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_update_animal()
    {
        $animal = factory(Animal::class)->create();
        $editedAnimal = factory(Animal::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/animal/animales/'.$animal->id,
            $editedAnimal
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_delete_animal()
    {
        $animal = factory(Animal::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/animal/animales/'.$animal->id
         )->assertStatus(200);


        $id=$animal->id;
        $datas=Animal::all();
        $active_estado=null;
        foreach ($datas as $data){
            if ($data->id=$id)
                $active_estado=$data->active;
        }

        $this->assertEquals(false,$active_estado);
    }

//    /**
//     * @test
//     */
//    public function test_importar_animales(){
//        $negocio =factory(Negocio::class)->create();
//        $negocio_id=$negocio->id;
//
//        Storage::fake('local');
//
//        $file = UploadedFile::fake()->create('finca.xls');
//
//        $this->response = $this->json(
//            'POST',
//            '/api/v1/animal/animales/import/'.$negocio_id
//        );
//    }
}
