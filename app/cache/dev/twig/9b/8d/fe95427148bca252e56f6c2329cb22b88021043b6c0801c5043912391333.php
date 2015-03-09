<?php

/* MainBundle:Default:show.html.twig */
class __TwigTemplate_9b8dfe95427148bca252e56f6c2329cb22b88021043b6c0801c5043912391333 extends Twig_Template
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
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/paintbrush.png"), "html", null, true);
        echo "\" />
    <h1 class=\"title\">Super Paint Kurwo</h1>
    <p>
         Witaj,  ";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "firstname", array()), "html", null, true);
        echo "
    </p>

    <a href=\"";
        // line 10
        echo $this->env->getExtension('routing')->getUrl("logout");
        echo "\"><b>Wyloguj</b></a>




";
    }

    public function getTemplateName()
    {
        return "MainBundle:Default:show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 10,  46 => 7,  39 => 4,  36 => 3,  11 => 1,);
    }
}
