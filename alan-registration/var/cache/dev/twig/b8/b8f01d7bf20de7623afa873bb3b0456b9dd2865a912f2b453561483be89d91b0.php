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

/* email/request.html.twig */
class __TwigTemplate_4d5e8eeee1adfb53cbcbdeeb66b6591d7333dd9ee3e480670aa88841253ee487 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "email/request.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "email/request.html.twig"));

        // line 1
        echo "<h2>Alan access request</h2>

<p>
    <span style=\"font-weight: 700 !important;\">Requested by</span><br/>
    ";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["request"]) || array_key_exists("request", $context) ? $context["request"] : (function () { throw new RuntimeError('Variable "request" does not exist.', 5, $this->source); })()), "firstName", [], "any", false, false, false, 5), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["request"]) || array_key_exists("request", $context) ? $context["request"] : (function () { throw new RuntimeError('Variable "request" does not exist.', 5, $this->source); })()), "lastName", [], "any", false, false, false, 5), "html", null, true);
        echo "
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Username</span><br/>
    ";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["request"]) || array_key_exists("request", $context) ? $context["request"] : (function () { throw new RuntimeError('Variable "request" does not exist.', 10, $this->source); })()), "username", [], "any", false, false, false, 10), "html", null, true);
        echo "
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Email</span><br/>
    ";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["request"]) || array_key_exists("request", $context) ? $context["request"] : (function () { throw new RuntimeError('Variable "request" does not exist.', 15, $this->source); })()), "userMail", [], "any", false, false, false, 15), "html", null, true);
        echo "
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Supervisor</span><br/>
    ";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["request"]) || array_key_exists("request", $context) ? $context["request"] : (function () { throw new RuntimeError('Variable "request" does not exist.', 20, $this->source); })()), "supervisorMail", [], "any", false, false, false, 20), "html", null, true);
        echo "
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Description</span><br/>
    ";
        // line 25
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["request"]) || array_key_exists("request", $context) ? $context["request"] : (function () { throw new RuntimeError('Variable "request" does not exist.', 25, $this->source); })()), "description", [], "any", false, false, false, 25), "html", null, true);
        echo "
</p>

";
        // line 28
        if ((isset($context["approveUrl"]) || array_key_exists("approveUrl", $context) ? $context["approveUrl"] : (function () { throw new RuntimeError('Variable "approveUrl" does not exist.', 28, $this->source); })())) {
            // line 29
            echo "    <p style=\"margin-top: 20px;\">
        <a
                href=\"";
            // line 31
            echo twig_escape_filter($this->env, (isset($context["approveUrl"]) || array_key_exists("approveUrl", $context) ? $context["approveUrl"] : (function () { throw new RuntimeError('Variable "approveUrl" does not exist.', 31, $this->source); })()), "html", null, true);
            echo "\"
                style=\"
                display: inline-block;
                text-decoration: none !important;
                font-weight: 400;
                text-align: center;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                color: #fff;
                background-color: #007bff;
                border-color: #007bff;\">
            Approve
        </a>
        <a
                href=\"";
            // line 53
            echo twig_escape_filter($this->env, (isset($context["denyUrl"]) || array_key_exists("denyUrl", $context) ? $context["denyUrl"] : (function () { throw new RuntimeError('Variable "denyUrl" does not exist.', 53, $this->source); })()), "html", null, true);
            echo "\"
                style=\"
                display: inline-block;
                text-decoration: none !important;
                font-weight: 400;
                text-align: center;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                color: #fff;
                background-color: #dc3545;
                border-color: #dc3545;
                margin-left: 10px;\">
            Deny
        </a>
    </p>
";
        }
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "email/request.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 53,  95 => 31,  91 => 29,  89 => 28,  83 => 25,  75 => 20,  67 => 15,  59 => 10,  49 => 5,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<h2>Alan access request</h2>

<p>
    <span style=\"font-weight: 700 !important;\">Requested by</span><br/>
    {{ request.firstName }} {{ request.lastName }}
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Username</span><br/>
    {{ request.username }}
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Email</span><br/>
    {{ request.userMail }}
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Supervisor</span><br/>
    {{ request.supervisorMail }}
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Description</span><br/>
    {{ request.description }}
</p>

{% if approveUrl %}
    <p style=\"margin-top: 20px;\">
        <a
                href=\"{{ approveUrl }}\"
                style=\"
                display: inline-block;
                text-decoration: none !important;
                font-weight: 400;
                text-align: center;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                color: #fff;
                background-color: #007bff;
                border-color: #007bff;\">
            Approve
        </a>
        <a
                href=\"{{ denyUrl }}\"
                style=\"
                display: inline-block;
                text-decoration: none !important;
                font-weight: 400;
                text-align: center;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                color: #fff;
                background-color: #dc3545;
                border-color: #dc3545;
                margin-left: 10px;\">
            Deny
        </a>
    </p>
{% endif %}", "email/request.html.twig", "/home/gaetan/development/alan-registration/alan-web/templates/email/request.html.twig");
    }
}
