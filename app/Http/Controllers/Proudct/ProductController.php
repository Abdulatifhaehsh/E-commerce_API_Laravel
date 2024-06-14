<?php

namespace App\Http\Controllers\Proudct;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\Product\CreateProductRequest;
use App\Http\Requests\Product\Product\GetProductByIdRequest;
use App\Http\Requests\Product\Product\GetProductRequest;
use App\Http\Requests\Product\Product\UploadImageProductRequest;
use App\Models\Product\Color;
use App\Models\Product\Product;
use Hashash\ProjectService\Helpers\FileClass;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private Product $products, private FileClass $fileClass)
    {

    }

    public function createProduct(CreateProductRequest $request) {
        $data = $request->validated();
        $user = $request->user();
        $data[Product::userId] = $user->id;
        $sizes = [];
        $colors = $data['colors'];
        $images = [];
        if($data['sizes'] != null) {
            $sizes = $data['sizes'];
            unset($data['sizes']);
        }
        unset($data['colors']);
        unset($data['images']);
        $files = $request->file('images');
        for ($i=0; $i < count($files); $i++) {
            $fileUri = $this->fileClass
                                ->uploadFile(
                                    $files[$i],
                                    time() . $i . '.' . $files[$i]->extension(),
                                    'images/product/'
                                );
            $images[$i]['image'] = $fileUri;
        }


        $createProduct = $this->products->createData($data);

        $createProduct->productImages()->createMany($images);

        foreach($sizes as $sizeId) {
            $createProduct->sizes()->attach($sizeId);
        }

        foreach($colors as $color) {
            $createOrFindColor = Color::firstOrCreate([Color::color => $color]);
            $createProduct->colors()->attach($createOrFindColor->id);
        }
        return ResponseHelper::create($createProduct->load(['sizes', 'colors', 'productImages']));
    }

    public function getProduct(GetProductRequest $request) {
        $data = $request->validated();
        return ResponseHelper::select($this->products->getProduct($data));
    }

    public function getProductById(GetProductByIdRequest $request, $id) {
        return ResponseHelper::select($this->products->getProductById($id));
    }

    public function uploadImage(UploadImageProductRequest $request)
    {
        $file = $request->file('image');
        $fileUri = $this->fileClass
                                ->uploadFile(
                                    $file,
                                    time() . '.' . $file->extension(),
                                    'images/product/'
                                );
        return ResponseHelper::create($fileUri);
    }
}
