<?php
namespace MagoArab\HideMassActions\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\AuthorizationInterface;

class MassActions extends \Magento\Backend\Block\Template
{
    protected $authorization;

    public function __construct(
        Context $context,
        AuthorizationInterface $authorization,
        array $data = []
    ) {
        $this->authorization = $authorization;
        parent::__construct($context, $data);
    }

    public function getAclPermissions()
    {
        // This is a simplified static list. You can make this dynamic if needed.
        $allActions = [
            'sales_order_cancel',
            'sales_order_hold',
            'sales_order_unhold',
            'sales_order_pdfinvoices',
            'sales_order_pdfshipments',
            'sales_order_pdfcreditmemos',
            'sales_order_pdfdocs',
            'sales_order_printshippinglabel'
        ];

        $allowed = [];
        foreach ($allActions as $action) {
            if ($this->authorization->isAllowed($action)) {
                $allowed[] = $action;
            }
        }
        return $allowed;
    }
}
