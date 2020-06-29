<?php


namespace App\Http\Requests\Backoffice\Store;


use App\Http\Requests\Interfaces\Backoffice\Store\CreateProductRequestInterface;
use App\Http\Requests\Interfaces\Backoffice\Store\UpdateProductRequestInterface;
use App\Primitives\NumberPrimitive;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest implements UpdateProductRequestInterface
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['max:191'],
            'description' => ['max:500'],
            'category' => ['max:191'],
            'price' => ['numeric', 'min:1'],
            'stock_amount' => ['required', 'numeric']
        ];
    }

    public function getName(): ? string
    {
        return $this->get('name');
    }

    public function getDescription(): ? string
    {
        return $this->get('description');
    }

    public function getCategory(): string
    {
        return $this->get('category');
    }

    public function getPrice(): ?NumberPrimitive
    {
        return $this->get('price') !== null ? NumberPrimitive::parse($this->get('price')) : null;
    }

    public function getStockAmount(): ? NumberPrimitive
    {
        return $this->get('stock_amount') !== null ? NumberPrimitive::parse($this->get('stock_amount')) : null;
    }
}
