<?php

namespace App\Rules;

use App\Facades\PurchaseFacade;
use Illuminate\Contracts\Validation\Rule;

class CheckProductRule implements Rule
{
    protected $message = '';

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $products = explode(',', config('product.products'));
        if (!in_array($value, $products)) {
            $this->message = 'The selected product is not valid.';
            return false;
        }
        if (!PurchaseFacade::hasInventory($value)) {
            $this->message = 'The selected product does not have enough inventory.';
            return false;
        }
        if (PurchaseFacade::coinInventory() < 1) {
            $this->message = 'You dont have enough coins.';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
