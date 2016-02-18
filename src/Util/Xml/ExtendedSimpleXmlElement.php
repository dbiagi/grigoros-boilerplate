<?php

namespace Grigoros\Util\Xml;

use SimpleXMLElement;

/**
 * Description of ExtendedSimpleXmlElement
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class ExtendedSimpleXmlElement extends SimpleXMLElement {

    public function addCDataChild($value) {
        $node = dom_import_simplexml($this);
        $no = $node->ownerDocument;
        
        $node->appendChild($no->createCDATASection($value));
    }

}
