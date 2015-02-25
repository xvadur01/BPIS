<?php

/** rozhranní pro generovanou továrničku */
interface IEventPlanningControlFactory
{
    /** @return \EventPlanningControl */
    function create();
}