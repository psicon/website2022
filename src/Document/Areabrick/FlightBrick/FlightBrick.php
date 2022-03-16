<?php

namespace App\Document\Areabrick\FlightBrick;

use Pimcore\Model\Document\Editable\Area\Info;
use Symfony\Component\HttpFoundation\Response;
use ToolboxBundle\Document\Areabrick\AbstractAreabrick;
use \Pimcore\Model\DataObject;


class MyBrick extends AbstractAreabrick
{
    public function action(Info $info): ?Response
    {
        //call this to activate all the toolbox magic.
    
        parent::action($info);
        
        $titleInput = $this->getDocumentEditable($info->getDocument(), 'input', 'relatedProducts');

        $info->setParams(array_merge($info->getParams(), [
            'relatedProducts' => $titleInput->getData(),
        ]));

        return null;

    }

    public function getTemplateDirectoryName():string
    {
        // this method is only required if your brick name (e.g. my_brick or myBrick)
        // differs from the view template name (e.g. my-brick)
        
        return 'flight-brick';
    }

    public function getTemplate(): string
    {
        // this method is only required if your brick name (e.g. my_brick or myBrick)
        // differs from the view template name (e.g. my-brick)
        
        return sprintf('areas/%s/view.%s', $this->getTemplateDirectoryName(), $this->getTemplateSuffix());
    }

    public function getName():string
    {
        return 'Flight Brick';
    }

    public function getDescription():string
    {
        return 'Flight Brick';
    }

    public function getIcon():string
    {
        return '/static/areas/flight-brick/icon.svg';
    }
}