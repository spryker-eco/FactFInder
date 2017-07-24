<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class SearchResultFeedbackForm extends AbstractType
{

    const FIELD_POSITIVE = 'positive';
    const FIELD_MESSAGE = 'message';
    const FORM_ID = 'searchResultFeedback';

    /**
     * @return string
     */
    public function getName()
    {
        return 'searchResultFeedbackForm';
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => [
                'id' => self::FORM_ID,
            ],
        ]);
    }

    /**
     * @deprecated Use `configureOptions()` instead.
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     *
     * @return void
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction('#');

        $this
            ->addPositiveField($builder)
            ->addMessageField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addPositiveField(FormBuilderInterface $builder)
    {
        $builder->add(self::FIELD_POSITIVE, 'choice', [
            'choices' => [
                'true' => 'factfinder.feedback.positive.value.positive',
                'false' => 'factfinder.feedback.positive.value.negative',
            ],
            'required' => true,
            'label' => 'factfinder.feedback.positive',
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addMessageField(FormBuilderInterface $builder)
    {
        $builder->add(self::FIELD_MESSAGE, 'text', [
            'label' => 'factfinder.feedback.message',
            'required' => false,
        ]);

        return $this;
    }

}
