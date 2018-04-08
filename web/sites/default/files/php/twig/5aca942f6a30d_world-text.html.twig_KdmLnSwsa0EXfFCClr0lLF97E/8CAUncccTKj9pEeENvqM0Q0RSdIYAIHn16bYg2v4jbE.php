<?php

/* modules/custom/gameengine/templates/dashboard/world-text.html.twig */
class __TwigTemplate_5b41d860d80c597ea64f72e53c4eba44fc1cb84680937fc80c2e5d2bfbcec2dc extends Twig_Template
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
        $tags = array();
        $filters = array("date" => 6);
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array(),
                array('date'),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 1
        echo "<div id=\"worldText\">
\t<div class=\"message\">
\t\tWelcome to the world of Thunder's Fury, traveler!
\t</div>
\t<div class=\"message\">
\t\tToday's date is ";
        // line 6
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_date_format_filter($this->env, ($context["time"] ?? null), "m/d/Y h:i A"), "html", null, true));
        echo "
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "modules/custom/gameengine/templates/dashboard/world-text.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 6,  43 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "modules/custom/gameengine/templates/dashboard/world-text.html.twig", "/var/www/thunder/web/modules/custom/gameengine/templates/dashboard/world-text.html.twig");
    }
}
