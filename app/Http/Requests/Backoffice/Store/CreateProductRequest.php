<?php


namespace App\Http\Requests\Backoffice\Store;


use App\Http\Requests\Interfaces\Backoffice\Store\CreateProductRequestInterface;
use App\Primitives\NumberPrimitive;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateProductRequest extends FormRequest implements CreateProductRequestInterface
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:191'],
            'description' => ['required', 'max:500'],
            'category' => ['required', 'max:191'],
            'price' => ['required', 'numeric', 'min:1'],
            'stock_amount' => ['required', 'numeric']
        ];
    }

    public function getName(): string
    {
        return $this->get('name');
    }

    public function createUUID(): string
    {
        return substr(base64_encode(Str::random(5) . Carbon::now()->toDateTimeString()), 0, 10);
    }

    public function getDescription(): string
    {
        return $this->get('description');
    }

    public function getCategory(): string
    {
        return $this->get('category');
    }

    public function getPrice(): NumberPrimitive
    {
        return NumberPrimitive::parse($this->get('price'));
    }

    public function getStockAmount(): NumberPrimitive
    {
        return NumberPrimitive::parse($this->get('stock_amount'));
    }
}
