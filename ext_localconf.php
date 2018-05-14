<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Schmidtch.' . $_EXTKEY, 'Surveylisting', array(
    'Survey' => 'newSurvey, createSurvey, addFormDate, list, show, updateForm, update, deleteConfirm, delete',
    'Appointment' => 'list, newAppointment,addFormTime, createAppointment, ajaxAdd, ajaxDelete, show, updateForm, updateFormAppointment, update, deleteConfirm, delete, newTimeOfDay, createTimeOfDay',
    'TimeOfDay' => 'list,addFormTime, add, ajaxAdd, show, updateForm, update, deleteConfirm, delete, deleteUpdateSurvey, deleteUpdateAppointment, deleteAddAppointment',
    'Subscriber' => 'list, add, addForm, show, showAfter, updateForm, update, deleteConfirm, delete, register, registerForm,, commentAjax',
    'Comment' => 'delete',
        ),
        // non-cacheable actions
        array(
    'Survey' => 'newSurvey, createSurvey, addFormDate, list, show, updateForm, update, deleteConfirm, delete',
    'Appointment' => 'list, newAppointment, addFormTime, createAppointment, ajaxAdd, ajaxDelete, show, updateForm, updateFormAppointment, update, deleteConfirm, delete, newTimeOfDay, createTimeOfDay',
    'TimeOfDay' => 'list,addFormTime, add, ajaxAdd, show, updateForm, update, deleteConfirm, delete, deleteUpdateSurvey, deleteUpdateAppointment, deleteAddAppointment',
    'Subscriber' => 'list, add, addForm, show, showAfter, updateForm, update, deleteConfirm, delete, register, registerForm, commentAjax',
    'Comment' => 'delete',
        )
);
