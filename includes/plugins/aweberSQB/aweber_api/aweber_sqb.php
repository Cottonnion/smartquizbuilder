<?php

class AWeberSQBCustom
{
    private $client_id;
    private $client_secret;
    private $access_token;
    private $redirect_uri;
    private $curl;
    public $refresh_token;
    public $token_expires_at;
    public function __construct($client_id, $client_secret, $redirect_uri)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->redirect_uri = $redirect_uri;

        // Initialize cURL
        $this->curl = curl_init();
    }

    public function __destruct()
    {
        // Clean up cURL resources
        curl_close($this->curl);
    }

    public function setToken($token){
        $this->access_token = $token;
    }

    public function getToken(){
        return $this->access_token;
    }

    public function getRefreshToken(){
        return $this->refresh_token;
    }

    public function setRefreshToken($v){
        $this->refresh_token = $v;
    }



    public function generateToken($authorization_code)
    {
        $token_endpoint = 'https://auth.aweber.com/oauth2/token';

        $data = array(
            'grant_type' => 'authorization_code',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code' => $authorization_code,
            'redirect_uri' => $this->redirect_uri,
        );

        curl_setopt($this->curl, CURLOPT_URL, $token_endpoint);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($this->curl);
        $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            $token_data = json_decode($response, true);
            $this->access_token = $token_data['access_token'];
            $this->refresh_token = $token_data['refresh_token'];
            $this->token_expires_at = time() + $token_data['expires_in'];
            
            return $this->access_token;
        } else {
            return false;
        }
    }

    public function getAccountDetails()
    {
        $api_endpoint = 'https://api.aweber.com/1.0/accounts';

        $ci = curl_init();
        curl_setopt($ci, CURLOPT_URL, $api_endpoint);
        curl_setopt($ci, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->access_token,
        ]);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ci);

        $httpCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            return json_decode($response, true);
        } else {
            return false;
        }
    }

    public function getLists($accountId)
    {
        $api_endpoint = 'https://api.aweber.com/1.0/accounts/'.$accountId.'/lists';

        $ci = curl_init();
        curl_setopt($ci, CURLOPT_URL, $api_endpoint);
        curl_setopt($ci, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->access_token,
        ]);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ci);

        $httpCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            return json_decode($response, true);
        } else {
            return false;
        }
    }

    public function addSubscriber($account_id,$list_id, $params)
    {
        $api_endpoint = "https://api.aweber.com/1.0/accounts/".$account_id."/lists/".$list_id."/subscribers";

        $ci = curl_init();
        curl_setopt($ci, CURLOPT_URL, $api_endpoint);
        curl_setopt($ci, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->access_token,
            'Content-Type: application/json',
        ]);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ci, CURLOPT_POST, true);
        curl_setopt($ci, CURLOPT_POSTFIELDS, json_encode($params));

        $response = curl_exec($ci); 


        $httpCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);

        if ($httpCode === 201) {
            return json_decode($response, true);
        } else {
            return false;
        }
    }

    public function getAuthorizationUrl()
    {
        $authorizationEndpoint = 'https://auth.aweber.com/oauth2/authorize';
        $query_params = array(
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
            'response_type' => 'code',
            'scope' => 'subscriber.read account.read list.read subscriber.write'
        );

        return $authorizationEndpoint . '?' . http_build_query($query_params);
    }

    public function refreshToken()
    {
        $token_endpoint = 'https://auth.aweber.com/oauth2/token';

        $data = array(
            'grant_type' => 'refresh_token',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'refresh_token' => $this->refresh_token,
        );

        curl_setopt($this->curl, CURLOPT_URL, $token_endpoint);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($this->curl);

        $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            $token_data = json_decode($response, true);
            $this->access_token = $token_data['access_token'];
            $this->refresh_token = $token_data['refresh_token'];
            $this->token_expires_at = time() + $token_data['expires_in'];
            return $this->access_token;
        } else {
            return false;
        }
    }

    public function isTokenValid(){
        
        $api_endpoint = 'https://api.aweber.com/1.0/accounts';

        curl_setopt($this->curl, CURLOPT_URL, $api_endpoint);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->access_token,
        ]);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($this->curl);
        $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            return true;
        } else {
            return false;
        }
    }


    public function updateSubscriber($account_id,$list_id, $subscriber_id, $data)
    {
        $api_endpoint = 'https://api.aweber.com/1.0/accounts/'.$account_id.'/lists/' . $list_id . '/subscribers/' . $subscriber_id;

        $ci = curl_init();
        curl_setopt($ci, CURLOPT_URL, $api_endpoint);
        curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ci, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->access_token,
            'Content-Type: application/json',
        ]);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ci, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ci);
        
        $httpCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            return true;
        } else {
            return false;
        }
    }


    public function getSubscriberByEmail($account_id,$list_id, $email){

        $api_endpoint = 'https://api.aweber.com/1.0/accounts/'.$account_id.'/lists/' . $list_id . '/subscribers';

        $query_params = array(
            'ws.op' => 'find',
            'email' => $email,
        );

        $ci = curl_init();
        curl_setopt($ci, CURLOPT_URL, $api_endpoint . '?' . http_build_query($query_params));
        curl_setopt($ci, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->access_token,
        ]);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ci);
        $httpCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            $subscribers = json_decode($response, true);
            if (!empty($subscribers['entries'])) {
                // Return the first subscriber found
                return $subscribers['entries'][0];
            }
        }

        return false;
    }

    public function deleteSubscriber($account_id,$list_id, $subscriber_id)
    {
        $api_endpoint = 'https://api.aweber.com/1.0/accounts/'.$account_id.'/lists/' . $list_id . '/subscribers/' . $subscriber_id;

        curl_setopt($this->curl, CURLOPT_URL, $api_endpoint);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->access_token,
        ]);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($this->curl);
        $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if ($httpCode === 204) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSubscriberByEmail($list_id, $email){
        // Get the subscriber by email
        $subscriber = $this->getSubscriberByEmail($list_id, $email);

        if (!$subscriber) {
            // Subscriber not found
            return false;
        }

        $subscriber_id = $subscriber['id'];

        // Delete the subscriber
        return $this->deleteSubscriber($list_id, $subscriber_id);
    }

}