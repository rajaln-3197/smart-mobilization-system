<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Autopilot\V1\Assistant;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $accountSid
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $friendlyName
 * @property array $links
 * @property string $assistantSid
 * @property string $sid
 * @property string $uniqueName
 * @property string $actionsUrl
 * @property string $url
 */
class TaskInstance extends InstanceResource {
    protected $_fields = null;
    protected $_samples = null;
    protected $_taskActions = null;
    protected $_statistics = null;

    /**
     * Initialize the TaskInstance
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $assistantSid The SID of the Assistant that is the parent of
     *                             the resource
     * @param string $sid The unique string that identifies the resource to fetch
     * @return \Twilio\Rest\Autopilot\V1\Assistant\TaskInstance
     */
    public function __construct(Version $version, array $payload, $assistantSid, $sid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'links' => Values::array_get($payload, 'links'),
            'assistantSid' => Values::array_get($payload, 'assistant_sid'),
            'sid' => Values::array_get($payload, 'sid'),
            'uniqueName' => Values::array_get($payload, 'unique_name'),
            'actionsUrl' => Values::array_get($payload, 'actions_url'),
            'url' => Values::array_get($payload, 'url'),
        );

        $this->solution = array('assistantSid' => $assistantSid, 'sid' => $sid ?: $this->properties['sid'], );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return \Twilio\Rest\Autopilot\V1\Assistant\TaskContext Context for this
     *                                                         TaskInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new TaskContext(
                $this->version,
                $this->solution['assistantSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a TaskInstance
     *
     * @return TaskInstance Fetched TaskInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Update the TaskInstance
     *
     * @param array|Options $options Optional Arguments
     * @return TaskInstance Updated TaskInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = array()) {
        return $this->proxy()->update($options);
    }

    /**
     * Deletes the TaskInstance
     *
     * @return boolean True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() {
        return $this->proxy()->delete();
    }

    /**
     * Access the fields
     *
     * @return \Twilio\Rest\Autopilot\V1\Assistant\Task\FieldList
     */
    protected function getFields() {
        return $this->proxy()->fields;
    }

    /**
     * Access the samples
     *
     * @return \Twilio\Rest\Autopilot\V1\Assistant\Task\SampleList
     */
    protected function getSamples() {
        return $this->proxy()->samples;
    }

    /**
     * Access the taskActions
     *
     * @return \Twilio\Rest\Autopilot\V1\Assistant\Task\TaskActionsList
     */
    protected function getTaskActions() {
        return $this->proxy()->taskActions;
    }

    /**
     * Access the statistics
     *
     * @return \Twilio\Rest\Autopilot\V1\Assistant\Task\TaskStatisticsList
     */
    protected function getStatistics() {
        return $this->proxy()->statistics;
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Autopilot.V1.TaskInstance ' . implode(' ', $context) . ']';
    }
}