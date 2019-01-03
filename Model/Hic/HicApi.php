<?php

namespace Magento\Braintree\Model\Hic;

use Magento\Framework\HTTP\Client\Curl;

/**
 * Class HicApi
 */
class HicApi
{

    const BASE_URL = "http://h30-local.hiconversion.net:9000/api/extensions/";
    const CREATE_ACCOUNT_URL = self::BASE_URL . "signup";
    const GET_SITES_URL = self::BASE_URL . "user/sites";

    /**
     * @var \Magento\Framework\HTTP\Client\Curl
     */
    private $curl;

    /**
     * StoreConfigResolver constructor.
     *
     * @param Curl $curl
     */
    public function __construct(
        Curl $curl,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->curl = $curl;

        $this->logger = $logger;
    }

    private function setDefaultCurlOpts()
    {
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, true);
        $this->curl->setOption(CURLOPT_ENCODING, "");
        $this->curl->setOption(CURLOPT_MAXREDIRS, 10);
        $this->curl->setOption(CURLOPT_TIMEOUT, 30);
        $this->curl->setOption(CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    }

    private function setDefaultHeaders()
    {
        $this->curl->setHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest'
            ]);
    }

    /**
     * creates a hiconversion account
     * @return mixed result from hic service
     */
    public function activateHicAccount($siteUrl, $email, $password)
    {
        $this->setDefaultCurlOpts();
        $this->setDefaultHeaders();

        $this->curl->post(self::CREATE_ACCOUNT_URL, json_encode([
            'email' => $email,
            'url' => $siteUrl,
            'password' => $password,
            'leadSource' => 'Braintree-Magento'
        
        ]));
        
        $this->logger->debug("HIC CURL BODY:" . $this->curl->getBody());

        return json_decode($this->curl->getBody(), true);
    }


    /**
     * retrieves site id corresponding to specified url from hic service
     * @return string|null site id
     */
    public function getHicSiteId($siteUrl, $email)
    {
        $this->setDefaultCurlOpts();
        $this->setDefaultHeaders();

        $this->curl->post(self::GET_SITES_URL, json_encode([
            'email' => $email
        ]));
        
        $sites = json_decode($this->curl->getBody(), true);
        $this->logger->debug("HIC SITES: " . print_r($sites, true));

        $siteId = null;
        if (is_array($sites)) {
            foreach ($sites as $site) {
                if (isset($site['url']) & $site['url'] == $siteUrl) {
                    $siteId = $site['external'];
                    break;
                }
            }
        }
        
        return $siteId;
    }
}
