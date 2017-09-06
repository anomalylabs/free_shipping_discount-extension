<?php namespace Anomaly\FreeShippingDiscountExtension;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Modifier\ModifierModel;
use Anomaly\DiscountsModule\Discount\DiscountExtension;
use Anomaly\FreeShippingDiscountExtension\Command\GetAmount;

/**
 * Class FreeShippingDiscountExtension
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FreeShippingDiscountExtension extends DiscountExtension
{

    /**
     * This extension provides a simple fixed
     * amount discount for the discounts module.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.discounts::discount.free_shipping';

    /**
     * Apply the discount.
     *
     * @param $target
     */
    public function apply($target)
    {
        foreach ($target->modifiers as $modifier) {

            if ($modifier->entry->toArray() == $this->getDiscount()->toArray()) {
                return;
            }
        }

        (new ModifierModel(
            [
                'type'  => 'discount',
                'cart'  => ($target instanceof CartInterface) ? $target : $target->cart,
                'item'  => ($target instanceof CartInterface) ? null : $target,
                'value' => '-' . $this->dispatch(new GetAmount($this)),
                'entry' => $this->getDiscount(),
            ]
        ))->save();
    }

}
