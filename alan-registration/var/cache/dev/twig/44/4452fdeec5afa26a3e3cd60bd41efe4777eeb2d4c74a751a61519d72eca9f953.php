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

/* email/request_approved.html.twig */
class __TwigTemplate_66439813d8a6caa390f9c7cd789f08c498c5f40b492a56cd1913952bb3f18fc2 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "email/request_approved.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "email/request_approved.html.twig"));

        // line 1
        echo "<p>
    Hello ";
        // line 2
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["request"]) || array_key_exists("request", $context) ? $context["request"] : (function () { throw new RuntimeError('Variable "request" does not exist.', 2, $this->source); })()), "firstName", [], "any", false, false, false, 2), "html", null, true);
        echo ",
</p>

<p>
    Your request to use the Alan cluster has been approved.
</p>

<p>(This is an automated e-mail, do not reply.)</p>

<p style=\"font-weight: 700 !important;\">Your credentials</p>

<p>
    <span style=\"font-weight: 700 !important;\">Username</span><br/>
    ";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["request"]) || array_key_exists("request", $context) ? $context["request"] : (function () { throw new RuntimeError('Variable "request" does not exist.', 15, $this->source); })()), "username", [], "any", false, false, false, 15), "html", null, true);
        echo "
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Password</span><br/>
    ";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["request"]) || array_key_exists("request", $context) ? $context["request"] : (function () { throw new RuntimeError('Variable "request" does not exist.', 20, $this->source); })()), "generatedPassword", [], "any", false, false, false, 20), "html", null, true);
        echo "
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Host</span><br/>
    ";
        // line 25
        echo twig_escape_filter($this->env, (isset($context["host"]) || array_key_exists("host", $context) ? $context["host"] : (function () { throw new RuntimeError('Variable "host" does not exist.', 25, $this->source); })()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["ip"]) || array_key_exists("ip", $context) ? $context["ip"] : (function () { throw new RuntimeError('Variable "ip" does not exist.', 25, $this->source); })()), "html", null, true);
        echo ")<br/>
    (from within the ULiège network only or through its VPN)
</p>

<p>
    Please check the documentation on<br/>
    https://github.com/montefiore-ai/alan-cluster and<br/>
    https://github.com/montefiore-ai/alan-cluster/tree/master/tutorials.<br/>
    If you have any issues or questions you can post them there.
</p>

<p>
    For documentation about Slurm, you can check<br/>
    https://support.ceci-hpc.be/doc/_contents/QuickStart/SubmittingJobs/SlurmTutorial.html.
</p>

<p>
    Please note that the cluster is primarily used by the researchers of the department.<br/>
    Read the documentation carefully before doing anything.<br/>
    If you have any questions, please ask us before trying anything you are unsure about.
</p>

<p>
    Kind regards.
</p>";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "email/request_approved.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 25,  70 => 20,  62 => 15,  46 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<p>
    Hello {{ request.firstName }},
</p>

<p>
    Your request to use the Alan cluster has been approved.
</p>

<p>(This is an automated e-mail, do not reply.)</p>

<p style=\"font-weight: 700 !important;\">Your credentials</p>

<p>
    <span style=\"font-weight: 700 !important;\">Username</span><br/>
    {{ request.username }}
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Password</span><br/>
    {{ request.generatedPassword }}
</p>

<p>
    <span style=\"font-weight: 700 !important;\">Host</span><br/>
    {{ host }} ({{ ip }})<br/>
    (from within the ULiège network only or through its VPN)
</p>

<p>
    Please check the documentation on<br/>
    https://github.com/montefiore-ai/alan-cluster and<br/>
    https://github.com/montefiore-ai/alan-cluster/tree/master/tutorials.<br/>
    If you have any issues or questions you can post them there.
</p>

<p>
    For documentation about Slurm, you can check<br/>
    https://support.ceci-hpc.be/doc/_contents/QuickStart/SubmittingJobs/SlurmTutorial.html.
</p>

<p>
    Please note that the cluster is primarily used by the researchers of the department.<br/>
    Read the documentation carefully before doing anything.<br/>
    If you have any questions, please ask us before trying anything you are unsure about.
</p>

<p>
    Kind regards.
</p>", "email/request_approved.html.twig", "/home/gaetan/development/alan-registration/alan-web/templates/email/request_approved.html.twig");
    }
}
