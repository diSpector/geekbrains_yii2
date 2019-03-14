<?php

namespace app\components\activity;


interface ActivityInterface
{
    public function getModel($params);
    public function getActivity($id);
    public function createActivity(&$model);
    public function updateActivity(&$model);
    public function deleteActivity($id);
    public function getSearchProvider($params);
    public function getSearchProviderWithQuery($query);
    public function getActivityToday();
    public function getAllActivitiesForUser($userId);
    public function getAllActivitiesWithNotificationsForUser($userId);
    public function getAllActivitiesForUserByToday($userId);
}