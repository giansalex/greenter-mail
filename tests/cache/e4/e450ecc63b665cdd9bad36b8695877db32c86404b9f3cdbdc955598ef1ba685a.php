<?php

/* embededDespatch.xml.twig */
class __TwigTemplate_bcf45ae23766f3970d29d7099f31ce329c74b214cc80e80e88762cf22c6c04ff extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<sac:SUNATEmbededDespatchAdvice>
    <cac:DeliveryAddress>
        <cbc:ID>";
        // line 3
        echo $this->getAttribute($this->getAttribute(($context["desp"] ?? null), "llegada", array()), "ubigueo", array());
        echo "</cbc:ID>
        <cbc:StreetName>";
        // line 4
        echo $this->getAttribute($this->getAttribute(($context["desp"] ?? null), "llegada", array()), "direccion", array());
        echo "</cbc:StreetName>
    </cac:DeliveryAddress>
    <cac:OriginAddress>
        <cbc:ID>";
        // line 7
        echo $this->getAttribute($this->getAttribute(($context["desp"] ?? null), "partida", array()), "ubigueo", array());
        echo "</cbc:ID>
        <cbc:StreetName>";
        // line 8
        echo $this->getAttribute($this->getAttribute(($context["desp"] ?? null), "partida", array()), "direccion", array());
        echo "</cbc:StreetName>
    </cac:OriginAddress>
    <sac:SUNATCarrierParty>
        <cbc:CustomerAssignedAccountID>";
        // line 11
        echo $this->getAttribute($this->getAttribute(($context["desp"] ?? null), "transportista", array()), "numDoc", array());
        echo "</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>";
        // line 12
        echo $this->getAttribute($this->getAttribute(($context["desp"] ?? null), "transportista", array()), "tipoDoc", array());
        echo "</cbc:AdditionalAccountID>
        <cac:Party>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName>";
        // line 15
        echo $this->getAttribute($this->getAttribute(($context["desp"] ?? null), "transportista", array()), "rznSocial", array());
        echo "</cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </sac:SUNATCarrierParty>
    <sac:DriverParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID>";
        // line 22
        echo $this->getAttribute(($context["desp"] ?? null), "nroLicencia", array());
        echo "</cbc:ID>
            </cac:PartyIdentification>
        </cac:Party>
    </sac:DriverParty>
    <sac:SUNATRoadTransport>
        <cbc:LicensePlateID>";
        // line 27
        echo $this->getAttribute(($context["desp"] ?? null), "transpPlaca", array());
        echo "</cbc:LicensePlateID>
        <cbc:TransportAuthorizationCode>";
        // line 28
        echo $this->getAttribute(($context["desp"] ?? null), "transpCodeAuth", array());
        echo "</cbc:TransportAuthorizationCode>
        <cbc:BrandName>";
        // line 29
        echo $this->getAttribute(($context["desp"] ?? null), "transpMarca", array());
        echo "</cbc:BrandName>
    </sac:SUNATRoadTransport>
    <cbc:TransportModeCode>";
        // line 31
        echo $this->getAttribute(($context["desp"] ?? null), "modTraslado", array());
        echo "</cbc:TransportModeCode>
    <cbc:GrossWeightMeasure unitCode=\"";
        // line 32
        echo $this->getAttribute(($context["desp"] ?? null), "undPesoBruto", array());
        echo "\">";
        echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), array($this->getAttribute(($context["desp"] ?? null), "pesoBruto", array())));
        echo "</cbc:GrossWeightMeasure>
</sac:SUNATEmbededDespatchAdvice>
";
    }

    public function getTemplateName()
    {
        return "embededDespatch.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 32,  84 => 31,  79 => 29,  75 => 28,  71 => 27,  63 => 22,  53 => 15,  47 => 12,  43 => 11,  37 => 8,  33 => 7,  27 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "embededDespatch.xml.twig", "/var/www/html/greenter-mail/vendor/greenter/xml/src/Xml/Templates/embededDespatch.xml.twig");
    }
}
