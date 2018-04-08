<?php

/* input.html.twig */
class __TwigTemplate_9c09d202c5312afb6b3762c6daa6eb10ee22fcfe2e165cb255e076be9bcb2552 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'input' => array($this, 'block_input'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("spaceless" => 22, "set" => 23, "if" => 25, "for" => 26, "block" => 47);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('spaceless', 'set', 'if', 'for', 'block'),
                array(),
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

        // line 22
        ob_start();
        // line 23
        $context["isDynDateTime"] = false;
        // line 24
        $context["isDynDateOnly"] = false;
        // line 25
        echo "  ";
        if (($context["input_group"] ?? null)) {
            // line 26
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["attributes"] ?? null), "class", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["attribute"]) {
                // line 27
                echo "        ";
                if (twig_in_filter("dynamic-date-time", $context["attribute"])) {
                    // line 28
                    echo "            ";
                    $context["isDynDateTime"] = true;
                    // line 29
                    echo "        ";
                } elseif (twig_in_filter("dynamic-date-only", $context["attribute"])) {
                    // line 30
                    echo "            ";
                    $context["isDynDateOnly"] = true;
                    // line 31
                    echo "        ";
                }
                // line 32
                echo "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attribute'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 33
            echo "
      ";
            // line 34
            if ((($context["isDynDateTime"] ?? null) == true)) {
                // line 35
                echo "        <div class=\"input-group DTPicker\">
      ";
            } elseif ((            // line 36
($context["isDynDateOnly"] ?? null) == true)) {
                // line 37
                echo "        <div class=\"input-group DPicker\">
      ";
            } else {
                // line 39
                echo "        <div class=\"input-group\">
      ";
            }
            // line 41
            echo "  ";
        }
        // line 42
        echo "
  ";
        // line 43
        if (($context["prefix"] ?? null)) {
            // line 44
            echo "    ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["prefix"] ?? null), "html", null, true));
            echo "
  ";
        }
        // line 46
        echo "
  ";
        // line 47
        $this->displayBlock('input', $context, $blocks);
        // line 50
        echo "
  ";
        // line 51
        if (($context["suffix"] ?? null)) {
            // line 52
            echo "      ";
            if ((($context["isDynDateTime"] ?? null) || ($context["isDynDateOnly"] ?? null))) {
                // line 53
                echo "          <span class=\"input-group-addon\">
              <span class=\"glyphicon glyphicon-calendar\"></span>
          </span>
      ";
            } else {
                // line 57
                echo "        ";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["suffix"] ?? null), "html", null, true));
                echo "
      ";
            }
            // line 59
            echo "  ";
        }
        // line 60
        echo "
  ";
        // line 61
        if (($context["input_group"] ?? null)) {
            // line 62
            echo "    </div>
  ";
        }
        // line 64
        echo "
  ";
        // line 65
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["children"] ?? null), "html", null, true));
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 47
    public function block_input($context, array $blocks = array())
    {
        // line 48
        echo "    <input";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["attributes"] ?? null), "html", null, true));
        echo " />
  ";
    }

    public function getTemplateName()
    {
        return "input.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 48,  158 => 47,  151 => 65,  148 => 64,  144 => 62,  142 => 61,  139 => 60,  136 => 59,  130 => 57,  124 => 53,  121 => 52,  119 => 51,  116 => 50,  114 => 47,  111 => 46,  105 => 44,  103 => 43,  100 => 42,  97 => 41,  93 => 39,  89 => 37,  87 => 36,  84 => 35,  82 => 34,  79 => 33,  73 => 32,  70 => 31,  67 => 30,  64 => 29,  61 => 28,  58 => 27,  53 => 26,  50 => 25,  48 => 24,  46 => 23,  44 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "input.html.twig", "themes/custom/atlas-bootstrap/templates/input/input.html.twig");
    }
}
