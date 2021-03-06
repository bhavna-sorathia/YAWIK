<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013 - 2016 Cross Solution (http://cross-solution.de)
 * @license   MIT
 */

/** TranslatorAwareMessage.php */
namespace Core\Mail;

use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\I18n\Translator\Translator;
use Zend\I18n\Translator\TranslatorInterface;

class TranslatorAwareMessage extends Message implements TranslatorAwareInterface
{
    protected $translator;
    protected $translatorEnabled = false;
    protected $translatorTextDomain = 'default';
    
    /**
     * @see \Zend\I18n\Translator\TranslatorAwareInterface::getTranslator()
     *
     * @return Translator
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /* (non-PHPdoc)
     * @see \Zend\I18n\Translator\TranslatorAwareInterface::getTranslatorTextDomain()
     */
    public function getTranslatorTextDomain()
    {
        return $this->translatorTextDomain;
    }

    /* (non-PHPdoc)
     * @see \Zend\I18n\Translator\TranslatorAwareInterface::hasTranslator()
     */
    public function hasTranslator()
    {
        return null !== $this->translator;
    }

    /* (non-PHPdoc)
     * @see \Zend\I18n\Translator\TranslatorAwareInterface::isTranslatorEnabled()
     */
    public function isTranslatorEnabled()
    {
        return $this->hasTranslator() && $this->translatorEnabled;
    }

    /* (non-PHPdoc)
     * @see \Zend\I18n\Translator\TranslatorAwareInterface::setTranslator()
     */
    public function setTranslator(TranslatorInterface $translator = null, $textDomain = null)
    {
        if ($translator) {
            $this->translator = $translator;
        }
        $this->setTranslatorTextDomain($textDomain);
        return $this;
    }

    /* (non-PHPdoc)
     * @see \Zend\I18n\Translator\TranslatorAwareInterface::setTranslatorEnabled()
     */
    public function setTranslatorEnabled($enabled = true)
    {
        $this->translatorEnabled = (bool) $enabled;
        return $this;
    }

    /* (non-PHPdoc)
     * @see \Zend\I18n\Translator\TranslatorAwareInterface::setTranslatorTextDomain()
     */
    public function setTranslatorTextDomain($textDomain = 'default')
    {
        $this->translatorTextDomain = $textDomain;
        return $this;
    }

    /**
     * Sets the message subject.
     *
     * The passed string is automatically translated if the second parameter is true (default).
     *
     * @param string $subject
     * @param bool $translate
     *
     * @since 0.19
     * @return Message
     */
    public function setSubject($subject, $translate = true)
    {

        if ($translate) {
            $translator = $this->getTranslator();
            $domain     = $this->getTranslatorTextDomain();

            $subject = $translator->translate($subject, $domain);
        }

        return parent::setSubject($subject);
    }

    public function setFormattedSubject($formatString)
    {
        $args       = func_get_args();
        $translator = $this->getTranslator();
        $args       = array_slice($args, 1);
        $domain     = $this->getTranslatorTextDomain();
        $subject    = $translator->translate($formatString, $domain);
        array_unshift($args, $subject);
        $subject    = call_user_func_array('sprintf', $args);
        return parent::setSubject($subject);
    }
}
