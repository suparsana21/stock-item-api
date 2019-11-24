<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product; // Include Product Class

class ProductController extends Controller
{
    
    /**
     * Show all list from item
     * @var Request
     * @return Eloquent Paginate
     */

     public function index(Request $request) // Acception request for filtering
     {
         $data = Product::select('products.*');

         $limit = 10;

         if(isset($request->search)) // Filtering product by name
         {
            $data->where('products.name','like',"%$request->search%");
         }

         if(isset($request->limit)) // set product length for each page
         {
             $limit = $request->limit;
         }

         return $data->paginate($limit);
     }

     /**
     * Show all list from item
     * @var Request
     * @return Eloquent Paginate
     */

     public function list(Request $request) // Acception request for filtering
     {
         $data = Product::select('products.*');

         $limit = 10;

         if(isset($request->limit)) // set product length for each page
         {
             $limit = $request->limit;
         }

         if(isset($request->type)) {
             switch ($request->type) {
                 case 'newly':
                     $data->orderBy('created_at');
                     break;
                 
                 default:
                     
                     break;
             }
         }

         return $this->successListResponse($data->get());
     }

     /**
     * Create Item
     * @var Request
     * @return Controller@successObjResponse
     */

    public function store(Request $request) // Acception request for store data
    {
        $values = [
            'name' => $request->name,
            'price' => $request->price,
            'code' => $request->code,
        ];

        try {
            $data = Product::create($values);

            return $this->successObjResponse($data);
        } catch (\Exception $e) {
            return $this->errorWithMessage(null,$e->getMessage());

        } catch (\Throwable $e) {
            return $this->errorWithMessage(null,$e->getMessage());
            
        }
        
    }

    /**
     * Show Item
     * @var int $id
     * @return Controller@successObjResponse
     */

    public function show($id) // Acception $id for find data
    {
        $data = Product::find($id);

        if($data) {
            return $this->successObjResponse($data);
        } else {
            return $this->errorNotFound();
        }
    }

    /**
     * Update Item
     * @var Request,int $id
     * @return Controller@successObjResponse
     */

    public function update(Request $request,$id) 
    {
        $data = Product::find($id);

        if(!$data) {
            return $this->errorNotFound();
        }

        $values = [
            'name' => $request->name,
            'price' => $request->price,
            'code' => $request->code,
        ];

        try {
            $data->update($values);

            $data = Product::find($data);

            return $this->successObjResponse($data);
        } catch (\Exception $e) {
            return $this->errorWithMessage(null,$e->getMessage());

        } catch (\Throwable $e) {
            return $this->errorWithMessage(null,$e->getMessage());
            
        }
        
    }

    /**
     * Delete Item
     * @var Request,int $id
     * @return Controller@successObjResponse
     */

    public function destroy(Request $request,$id) 
    {
        $data = Product::find($id);

        if(!$data) {
            return $this->errorNotFound();
        }
        try {
            $data->delete();

            return $this->successObjResponse(null);
        } catch (\Exception $e) {
            return $this->errorWithMessage(null,$e->getMessage());

        } catch (\Throwable $e) {
            return $this->errorWithMessage(null,$e->getMessage());
            
        }
        
    }

}