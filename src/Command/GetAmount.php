<?php namespace Anomaly\FreeShippingDiscountExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\FreeShippingDiscountExtension\FreeShippingDiscountExtension;

/**
 * Class GetAmount
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetAmount
{

    /**
     * The extension instance.
     *
     * @var FreeShippingDiscountExtension
     */
    protected $extension;

    /**
     * Create a new GetAmount instance.
     *
     * @param FreeShippingDiscountExtension $extension
     */
    public function __construct(FreeShippingDiscountExtension $extension)
    {
        $this->extension = $extension;
    }

    /**
     * Handle the command.
     *
     * @param ConfigurationRepositoryInterface $configuration
     * @return mixed|null
     */
    public function handle(ConfigurationRepositoryInterface $configuration)
    {
        return $configuration->value(
            $this->extension->getNamespace('amount'),
            $this->extension->getDiscountId()
        );
    }
}
