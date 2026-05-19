<?php 

/* PHP Class for HubspotSQB API */

class hubspotSQB {
	

	
    private $auth_token;

    function __construct($auth_token){
        $this->auth_token = $auth_token;
    }

    public function setAuthToken($auth_token) {
        $this->auth_token = $auth_token;
    }
    
     public function register($email = '', $name = '', $params = '', $customFields = ''){
		 
		$params = explode ( ":", $params );	

        $list_id = '';
        if(isset($params[2])){
        $list_id = $params[2];
        }
        $tag = '';
        if(isset($params[3]) && $params[3] != ''){
            $tag =  $params[3]; 
        }
		
		 
		$merge_fields = array();

        $merge_fields = array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => $email
                ),
                array(
                    'property' => 'firstname',
                    'value' => $name
                ),
            )
        );
		
		return $this->addSubscriber($list_id,$merge_fields,$email);
     }

    /******* CAMPAIGNS *******/

    /** createCampaign
        Parameters:
            name = Nombre de la campaña (no es público)
            from_name = Nombre del remitente de la campaña
            from_email = El email desde el que se enviará la campaña
            subject = El asunto de la campaña
            content = El HTML que contendrá la campaña
            list = Los identificadores de las listas a las que se enviará la campaña
        Example: createCampaign("Campaign Test", "John Doe", "john@doe.com", "Email Subject", "Email Content",
                  array(
                    '0' => '1000'
                  ));
    **/

    public function createCampaign($name, $from_name, $from_email, $subject, $content, $lists){
        $request = "createCampaign";

        $list_array=array();

        foreach ($lists as $key=>$value) {
            $list_array['lists['.$key.']']=$value;
        }

        $data = array(
            'name'        => $name,
            'from_name'   => $from_name,
            'from_email'  => $from_email,
            'subject'     => $subject,
            'content'     => $content,
        );

        $data=array_merge($data,$list_array);

        return $this->callAPI($request, $data);
    }

    /** getCampaigns
        Example:
            getCampaigns()
    **/

    public function getCampaigns(){
        $request = "getCampaigns";
        return $this->callAPI($request);
    }

    /** getCampaignBasicInformation
        Parameters:
            campaign_id = Identificador de la campaña de la que quieres obtener la información
        Example:
            getCampaignBasicInformation("1000")
    **/

    public function getCampaignBasicInformation($campaign_id){
        $request = "getCampaignBasicInformation";
        $data = array(
            'campaign_id' => $campaign_id
        );
        return $this->callAPI($request, $data);
    }

    /** getCampaignTotalInformation
        Parameters:
            campaign_id = Identificador de la campaña de la que quieres obtener la información
        Example:
            getCampaignTotalInformation("1000")
    **/

    public function getCampaignTotalInformation($campaign_id){
        $request = "getCampaignTotalInformation";
        $data = array(
            'campaign_id' => $campaign_id
        );
        return $this->callAPI($request, $data);
    }

    /** getCampaignHTML
        Parameters:
            campaign_id = Identificador de la campaña de la que quieres obtener la información
        Example:
            getCampaignHTML("1000")
    **/

    public function getCampaignHTML($campaign_id){
        $request = "getCampaignHTML";
        $data = array(
            'campaign_id' => $campaign_id
        );
        return $this->callAPI($request, $data);
    }

    /** getCampaignOpenersByCountries
        Parameters:
            campaign_id = Identificador de la campaña de la que quieres obtener la información
        Example:
            getCampaignOpenersByCountries("1000")
    **/

    public function getCampaignOpenersByCountries($campaign_id){
        $request = "getCampaignOpenersByCountries";
        $data = array(
            'campaign_id' => $campaign_id
        );
        return $this->callAPI($request, $data);
    }

    /** getCampaignInformationByISP
        Parameters:
            campaign_id = Identificador de la campaña de la que quieres obtener la información
        Example:
            getCampaignInformationByISP("1000")
    **/

    public function getCampaignInformationByISP($campaign_id){
        $request = "getCampaignInformationByISP";
        $data = array(
            'campaign_id' => $campaign_id
        );
        return $this->callAPI($request, $data);
    }

    /******* SUSCRIBERS *******/

    /** createList
        Parameters:
            sender_email = El email que se utilizará para las notificaciones de la lista
            name = Nombre de la lista
            company = La empresa a la que pertenece la lista
            country = El país de procedencia de la lista
            city = La ciudad de la empresa
            address = La dirección de la empresa
            phone = El teléfono de la empresa
        Example:
            createList("john@doe.com", "John Doe", "MailServicios", "Spain", "Madrid", "Calle Falsa, 1", "91000000")
    **/

    public function createList($sender_email,$name,$company,$country,$city,$address,$phone){
        $request = "createList";
        $data = array(
            'sender_email' => $sender_email,
            'name'         => $name,
            'company'      => $company,
            'country'      => $country,
            'city'         => $city,
            'address'      => $address,
            'phone'        => $phone,
        );
        return $this->callAPI($request, $data);
    }

    /** deleteList
        Parameters:
            list_id = Identificador de la lista
        Example:
            deleteList("1000")
    **/

    public function deleteList($list_id){
        $request = "deleteList";
        $data = array('list_id' => $list_id);
        return $this->callAPI($request, $data);
    }

    /** deleteSubscriber
        Parameters:
            list_id = Identificador de la lista
            email = Email del suscriptor
        Example:
            deleteSubscriber("1000", "john2@doe.com")
    **/

    public function deleteSubscriber($list_id, $email){
        $request = "deleteSubscriber";
        $data = array(
            'list_id' => $list_id,
            'email' => $email,
        );
        return $this->callAPI($request, $data);
    }

    /** getSubscribers
        Parameters:
            list_id = Identificador de la lista
            status = (Opcional) Segmenta los suscriptores por estado.
                                0: suscriptores activos.
                                1: suscriptores sin verificar.
                                2: suscriptores que se han dado de baja.
                                3: suscriptores hard bounced.
                                4: suscriptores que se han quejado.
        Example:
            getSubscribers("1000", "0")
    **/

    public function getSubscriber($email){
        $request = "contact/email/".$email."/profile";
        return $this->callAPI($request, array());
    }

    public function addMergeTag($list_id,$field_name,$field_type){
        $request = "addMergeTag";
        $data = array(
            'list_id' => $list_id,
            'field_name' => $field_name,
            'field_type' => $field_type,
        );
        return $this->callAPI($request, $data);
    }

    public function addSubscriber($list_id,$merge_fields,$email){
        $request = "contact";
        $merge_fields_send=array();

        /*foreach (array_keys($merge_fields) as $merge_field) {
            $merge_fields_send['merge_fields['.$merge_field.']']=$merge_fields[$merge_field];
        }*/

        $subscriber = $this->callAPI($request, $merge_fields,'POST');

        if(!empty($subscriber['vid']) || !empty($subscriber['identityProfile']['vid'])){

            $vid = $vid = !empty($subscriber['vid']) ? $subscriber['vid'] : $subscriber['identityProfile']['vid'];
            
            $listarray = array(
                'vids' => array($vid),
                'emails' => array($email)
            );
            
            $attach = $this->callAPI('lists/'.$list_id.'/add',$listarray,'POST');
            
      
        }
        
        return $subscriber;
    }


    /** getLists
            Example: getLists();
    **/

    public function getLists(){
        $request = "lists";

        if(defined('INCREASE_LIST_LIMIT')){
            $limit = INCREASE_LIST_LIMIT;
        }else{
            $limit = 100;
        }

        $lists_info =  $this->callAPI($request,array('count'=>$limit));

        $lists_data = null;
		if(!empty($lists_info['lists'])){
			$i = 0;
			foreach($lists_info['lists'] as $list_id=>$list_info){
                if($list_info['listType'] == 'STATIC'){
                    $lists_data[$i]['list_id'] = $list_info['listId'];
                    $lists_data[$i]['list_name'] = $list_info['name']; 
                    $i++;
                }
            }
		}
        
		return $lists_data;
        
    }



    public function getFields($list_id){
        $request = "getFields";
        $data = array('list_id' => $list_id);
        return $this->callAPI($request, $data);
    }

    /** batchAddSubscribers
            Parameters:
                list_id = Identificador de la lista
                subscribers_data = Un array que contenga los mergetags del suscriptor como
                                   claves y el valor que se quiere agregar al suscriptor.
            Example: batchAddSubscribers("1000", array(
                                                        array("email" => "john@doe.com"),
                                                        array("email" => "john2@doe.com"),));
    **/
    public function batchAddSubscribers($list_id, $subscribers_data){
        $request = "batchAddSubscribers";

        $subscribers_data = json_encode($subscribers_data);

        $data = array(
            "list_id" => $list_id,
            "subscribers_data" => $subscribers_data
        );

        $this->callAPI($request, $data);
    }

    /** getCampaignOpeners
            Parameters:
                campaign_id = Identificador de la campaña de la que quieres obtener la información
            Example: getCampaignOpeners(1000);
    **/

   

    // callAPI($request, $data = array())
    // Realiza la llamada a la API de Acumbamail con los datos proporcionados
    function callAPI($request, $data = array(),$http_method = 'GET'){
		
		 try {
			 
			$url = "https://api.hubapi.com/contacts/v1/".$request.'';

			/*$fields = array(
				'auth_token'=> $this->auth_token,
				'response_type' => 'json',
			);*/
			$fields = array();
			if(!empty($data)){
				$fields=array_merge($fields,$data);
			}
	  
		    $postdata = http_build_query($data);
			
			if($http_method == 'GET'){
				$url = $url.'?'.$postdata;
			}
			
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			
			if($http_method == 'POST'){
				curl_setopt($curl, CURLOPT_POST, true);
			}
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
                'Authorization: Bearer ' . $this->auth_token,
                'Content-Type: application/json',
			);
			if($http_method == 'POST'){
			$headers = array(
                    'Authorization: Bearer ' . $this->auth_token,
                    'Content-Type: application/json',
				);
			}
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			
			if($http_method == 'POST'){
				curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
			}
				
			$response = curl_exec($curl);

			$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

			curl_close($curl);
		
			if($httpCode == "200"){
				return json_decode($response,true);
			}else if($httpCode == "409"){
                return json_decode($response,true);
            }
			return null;
		 }catch (PDOException $e) {
			
			return null;
			
		} catch (Exception $e) {
			
			return null;
		}
        
    }
}
