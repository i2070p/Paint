<?php

/* MainBundle:Default:index.html.twig */
class __TwigTemplate_bf41ded65a44d39097a2082882cd77a374eeaf067668498a7d76cb3d85f564d0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("MainBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'content_header_more' => array($this, 'block_content_header_more'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MainBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 4
        echo "    logged in as <strong>sdfsdfsdf</strong> - <a href=\"sdsdfsdfsdf\">Logout</a>
";
    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        // line 8
        echo "    <img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/paintbrush.png"), "html", null, true);
        echo "\" />
    <h1 class=\"title\">Super Paint Kurwo</h1>
    <p>
        Witaj na stronie głównej.
    </p>
    <ul>
        <li><a href=\"";
        // line 14
        echo $this->env->getExtension('routing')->getUrl("account");
        echo "\"><b>Zaloguj</b></a></li>
        <li><a href=\"";
        // line 15
        echo $this->env->getExtension('routing')->getUrl("account_register");
        echo "\"><b>Zarejestruj</b></a></li>
        <li></li>
        <li><a href=\"http://www.google.pl/\">Google</a></li>
        <li><a href=\"http://symfony-docs.pl\">Dokumentacja symfony</a></li>
    </ul>



";
    }

    public function getTemplateName()
    {
        return "MainBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 15,  58 => 14,  48 => 8,  45 => 7,  40 => 4,  37 => 3,  11 => 1,);
    }
}
