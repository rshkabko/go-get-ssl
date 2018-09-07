<?php

namespace GoGetSSL;

/**
 * Class Tools
 *
 * @package GoGetSSL
 * @author alzo02 <alzo02@icloud.com>
 */
class Tools
{
    protected $api;

    function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
    * @param $supplier_id - integer value; for Comodo: 1, for Geotrust/Symantec/Thawte: 2
     *
     * @return object | null
     */
    public function getWebServers($supplier_id = 2)
    {
        return $this->api->get("/tools/webservers/{$supplier_id}");
    }

    /**
     * @param $domain - valid FQDN
     *
     * @return array of valid email addresses from Comodo API
     */
    public function getDomainEmails($domain)
    {
        return $this->api->post("/tools/domain/emails/", [
            'domain' => $domain
        ]);
    }

    /**
     * @param $domain - valid FQDN
     *
     * @return array of valid email addresses from Comodo API
     */
    public function getDomainEmailsForGeotrust($domain)
    {
        return $this->api->post("/tools/domain/emails/geotrust/", [
            'domain' => $domain
        ]);
    }


    /**
     * Generate CSR to domain
     *
     * @param $domain Domain name
     * @param $email
     * @param $country
     * @param $state
     * @param $city
     * @param string $organization The name of organization
     * @param string $department IT is defaults
     * @return string | null
     */
    public function generateCSR($domain, $email, $country, $state, $city, $organization = "None", $department = 'IT')
    {
        return $this->api->post("/tools/csr/generate/", [
            'csr_commonname'    => $domain,
            'csr_email'         => $email,
            'csr_country'       => $country,
            'csr_state'         => $state,
            'csr_city'          => $city,
            'csr_organization'  => $organization,
            'csr_department'    => $department,
        ]);
    }
}
