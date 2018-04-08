<?php

/* themes/custom/atlas-bootstrap/templates/system/page--front.html.twig */
class __TwigTemplate_20ef24e1cf72285ff96384beae10cdcc7410b9bc44804eeb7a1923302fa67d40 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'navbar' => array($this, 'block_navbar'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("set" => 59, "if" => 61, "block" => 62);
        $filters = array("clean_class" => 67, "t" => 76);
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('set', 'if', 'block'),
                array('clean_class', 't'),
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

        // line 59
        $context["container"] = (($this->getAttribute($this->getAttribute(($context["theme"] ?? null), "settings", array()), "fluid_container", array())) ? ("container-fluid") : ("container"));
        // line 61
        if (($this->getAttribute(($context["page"] ?? null), "navigation", array()) || $this->getAttribute(($context["page"] ?? null), "navigation_collapsible", array()))) {
            // line 62
            echo "  ";
            $this->displayBlock('navbar', $context, $blocks);
        }
        // line 93
        echo "
";
        // line 95
        echo "
";
        // line 96
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "content", array()), "html", null, true));
    }

    // line 62
    public function block_navbar($context, array $blocks = array())
    {
        // line 63
        echo "    ";
        // line 64
        $context["navbar_classes"] = array(0 => "navbar", 1 => (($this->getAttribute($this->getAttribute(        // line 66
($context["theme"] ?? null), "settings", array()), "navbar_inverse", array())) ? ("navbar-inverse") : ("navbar-default")), 2 => (($this->getAttribute($this->getAttribute(        // line 67
($context["theme"] ?? null), "settings", array()), "navbar_position", array())) ? (("navbar-" . \Drupal\Component\Utility\Html::getClass($this->getAttribute($this->getAttribute(($context["theme"] ?? null), "settings", array()), "navbar_position", array())))) : (($context["container"] ?? null))));
        // line 70
        echo "    <header";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["navbar_attributes"] ?? null), "addClass", array(0 => ($context["navbar_classes"] ?? null)), "method"), "html", null, true));
        echo " id=\"navbar\" role=\"banner\">
      <div class=\"navbar-header\">
        ";
        // line 72
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "navigation", array()), "html", null, true));
        echo "
        ";
        // line 74
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "navigation_collapsible", array())) {
            // line 75
            echo "          <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#navbar-collapse\">
            <span class=\"sr-only\">";
            // line 76
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Toggle navigation")));
            echo "</span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
        ";
        }
        // line 82
        echo "      </div>

      ";
        // line 85
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "navigation_collapsible", array())) {
            // line 86
            echo "        <div id=\"navbar-collapse\" class=\"navbar-collapse collapse\">
          ";
            // line 87
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "navigation_collapsible", array()), "html", null, true));
            echo "
        </div>
      ";
        }
        // line 90
        echo "    </header>
  ";
    }

    public function getTemplateName()
    {
        return "themes/custom/atlas-bootstrap/templates/system/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 90,  106 => 87,  103 => 86,  100 => 85,  96 => 82,  87 => 76,  84 => 75,  81 => 74,  77 => 72,  71 => 70,  69 => 67,  68 => 66,  67 => 64,  65 => 63,  62 => 62,  58 => 96,  55 => 95,  52 => 93,  48 => 62,  46 => 61,  44 => 59,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "themes/custom/atlas-bootstrap/templates/system/page--front.html.twig", "/var/www/thunder/web/themes/custom/atlas-bootstrap/templates/system/page--front.html.twig");
    }
}
