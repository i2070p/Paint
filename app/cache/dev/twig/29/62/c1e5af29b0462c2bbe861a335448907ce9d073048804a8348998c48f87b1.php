<?php

/* MainBundle:Account:register.html.twig */
class __TwigTemplate_2962c1e5af29b0462c2bbe861a335448907ce9d073048804a8348998c48f87b1 extends Twig_Template
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
        echo "    <h1 class=\"title\">Register</h1>

    <p>
        Choose between two default users: <em>user/userpass</em>
        <small>(ROLE_USER)</small>
        or <em>admin/adminpass</em>
        <small>(ROLE_ADMIN)</small>
    </p>

    ";
        // line 13
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
    ";
        // line 14
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
    Email:   <br> ";
        // line 15
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "user", array()), "email", array()), 'widget');
        echo " <br>
    Password:  <br> ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "user", array()), "plainPassword", array()), "password", array()), 'widget');
        echo "  <br>
    Confirm:  <br> ";
        // line 17
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "user", array()), "plainPassword", array()), "confirm", array()), 'widget');
        echo "  <br>
    Terms:  <br> ";
        // line 18
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "terms", array()), 'widget');
        echo "  <br>
    <br> ";
        // line 19
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "Register", array()), 'widget', array("label" => "Register"));
        echo "  <br>
    ";
        // line 20
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
    
";
    }

    public function getTemplateName()
    {
        return "MainBundle:Account:register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 20,  74 => 19,  70 => 18,  66 => 17,  62 => 16,  58 => 15,  54 => 14,  50 => 13,  39 => 4,  36 => 3,  11 => 1,);
    }
}
