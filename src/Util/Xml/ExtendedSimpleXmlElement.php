<?php

namespace Util\Xml;

use SimpleXMLElement;

/**
 * Description of ExtendedSimpleXmlElement
 *
 * @author Diego Viana <diego.viana@lecom.com.br>
 */
class ExtendedSimpleXmlElement extends SimpleXMLElement {

    public function addCDataChild($value) {
        $node = dom_import_simplexml($this);
        $no = $node->ownerDocument;
        
        $node->appendChild($no->createCDATASection($value));
    }

}
