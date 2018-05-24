<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Schmidtch.' . $_EXTKEY, 'web', // Main area
        'mod1', // Name of the module
        '', // Position of the module
        array(// Allowed controller action combinations
        'Appointment' => 'list, newAppointment, addFormTime, createAppointment, ajaxAdd, ajaxDelete, show, updateForm, updateFormAppointment, update, deleteConfirm, delete, newTimeOfDay, createTimeOfDay',
        ), array(// Additional configuration
        'access' => 'user,group',
        'icon' => 'EXT:survey/ext_icon.gif',
        'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml',
        )
    );
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Schmidtch.' . $_EXTKEY, 'Surveylisting', 'Survey - Surveylisting'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Survey Extension');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_survey_domain_model_organizer', 'EXT:survey/Resources/Private/Language/locallang_csh_tx_survey_domain_model_organizer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_survey_domain_model_organizer');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_survey_domain_model_survey', 'EXT:survey/Resources/Private/Language/locallang_csh_tx_survey_domain_model_survey.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_survey_domain_model_survey');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_survey_domain_model_subscriber', 'EXT:survey/Resources/Private/Language/locallang_csh_tx_survey_domain_model_subscriber.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_survey_domain_model_subscriber');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_survey_domain_model_appointment', 'EXT:survey/Resources/Private/Language/locallang_csh_tx_survey_domain_model_appointment.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_survey_domain_model_appointment');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_survey_domain_model_timeofday', 'EXT:survey/Resources/Private/Language/locallang_csh_tx_survey_domain_model_timeofday.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_survey_domain_model_timeofday');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_survey_domain_model_comment', 'EXT:survey/Resources/Private/Language/locallang_csh_tx_survey_domain_model_comment.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_survey_domain_model_comment');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_survey_domain_model_poll', 'EXT:survey/Resources/Private/Language/locallang_csh_tx_survey_domain_model_poll.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_survey_domain_model_poll');
