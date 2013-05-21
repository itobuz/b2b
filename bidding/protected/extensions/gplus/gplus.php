<?

class gplus extends CApplicationComponent {

    private $clientId = null;
    private $clientSecret = null;
    // Make sure that this matches a registered redirect URI for your app
    private $redirectUri = null;
    // This is the API key for 'Simple API Access'
    private $developerKey = null;

    public function init() {
        $path = dirname(__FILE__) . '/src';
        set_include_path(get_include_path() . PATH_SEPARATOR . $path);
        parent::init();
    }

    public function test() {
        echo "Client ID : {$this->clientId}, Client Secret: {$this->clientSecret} , Redirect URL: {$this->redirectUri}";
    }

    public function getclientId() {
        return $this->clientId;
    }

    public function setclientId($clientId) {
        $this->clientId = $clientId;
    }

    public function getClientSecret() {
        return $this->clientSecret;
    }

    public function setClientSecret($clientSecret) {
        $this->clientSecret = $clientSecret;
    }

    public function getRedirectUri() {
        return $this->redirectUri;
    }

    public function setRedirectUri($redirectUri) {
        $this->redirectUri = $redirectUri;
    }

    public function getDeveloperKey() {
        return $this->developerKey;
    }

    public function setDeveloperKey($developerKey) {
        $this->developerKey = $developerKey;
    }

}