<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* email/request_denied.html.twig */
class __TwigTemplate_5e4619e90a20a90d0272b333564170e849906a943f44aa01a007317d89fa0b88 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "email/request_denied.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "email/request_denied.html.twig"));

        // line 1
        echo "<p>
    Hello ";
        // line 2
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["request"]) || array_key_exists("request", $context) ? $context["request"] : (function () { throw new RuntimeError('Variable "request" does not exist.', 2, $this->source); })()), "firstName", [], "any", false, false, false, 2), "html", null, true);
        echo "
</p>

<p>
    Your request to use the Alan cluster has been <span style=\"font-weight: 700 !important;\">denied</span> by the cluster administrator.
</p>

";
        // line 9
        if ((isset($context["reason"]) || array_key_exists("reason", $context) ? $context["reason"] : (function () { throw new RuntimeError('Variable "reason" does not exist.', 9, $this->source); })())) {
            // line 10
            echo "    <p>The following explanation has been given by the cluster administrator for the denial:</p>
    <p>";
            // line 11
            echo twig_escape_filter($this->env, (isset($context["reason"]) || array_key_exists("reason", $context) ? $context["reason"] : (function () { throw new RuntimeError('Variable "reason" does not exist.', 11, $this->source); })()), "html", null, true);
            echo "</p>
";
        }
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "email/request_denied.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 11,  58 => 10,  56 => 9,  46 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<p>
    Hello {{ request.firstName }}
</p>

<p>
    Your request to use the Alan cluster has been <span style=\"font-weight: 700 !important;\">denied</span> by the cluster administrator.
</p>

{% if reason %}
    <p>The following explanation has been given by the cluster administrator for the denial:</p>
    <p>{{ reason }}</p>
{% endif %}", "email/request_denied.html.twig", "/home/gaetan/development/alan-registration/alan-web/templates/email/request_denied.html.twig");
    }
}
