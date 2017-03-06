<?php

/**
 * Class Waardes
 */
class Waardes
{
    /**
     * @var PDO
     */
    private $db;
    /**
     * @var int
     */
    private $scan_id;
    /**
     * @var int
     */
    private $device_id;
    /**
     * @var string
     */
    private $date;
    /**
     * @var string
     */
    private $location;
    /**
     * @var string
     */
    private $temperature;
    /**
     * @var int
     */
    private $moisture;
    /**
     * @var string
     */
    private $scanname;
    /**
     * @var int
     */
    private $kobaltppm;
    /**
     * @var int
     */
    private $kobalt_warning;
    /**
     * @var int
     */
    private $kobalt_intervene;
    /**
     * @var int
     */
    private $cadmiumppm;
    /**
     * @var int
     */
    private $cadmium_warning;
    /**
     * @var int
     */
    private $cadmium_intervene;
    /**
     * @var int
     */

    private $koperppm;
    /**
     * @var int
     */
    private $koper_warning;
    /**
     * @var int
     */
    private $koper_intervene;
    /**
     * @var int
     */
    private $loodppm;
    /**
     * @var int
     */
    private $lood_warning;
    /**
     * @var int
     */
    private $lood_intervene;
    /**
     * @param int
     */
    private $kwikppm;
    /**
     * @var int
     */
    private $kwik_warning;
    /**
     * @var int
     */
    private $kwik_intervene;
    /**
     * @var int
     */
    private $zinkppm;
    /**
     * @var int
     */
    private $zink_warning;
    /**
     * @var int
     */
    private $zink_intervene;
    /**
     * @var int
     */


    private $lastinsertedid;
    /**
     * @param string
     */
    private $lat;

    /**
     * @param string
     */
    private $lng;

    /**
     * @var array
     */
    private $waardes_info = array();

    /**
     * @param $dbconnection
     * @param string $productID
     */
    public function __construct($dbconnection, $scan_id = null)
    {
        $this->db = $dbconnection;

        if (is_numeric($scan_id) && $scan_id != null) {
            $this->read($scan_id);
        }
    }

    /**
     *
     */
    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO waardes(locatie, temperatuur, vochtigheid, naam_scan, kobalt_ppm, cadmium_ppm, koper_ppm, kwik_ppm, lood_ppm, zink_ppm)
                                    VALUES(:loca, :temp, :mois, :sname, :kobppm, :cadppm, :kopppm, :kwippm, :looppm, :zinppm)");
            $stmt->bindParam(":loca", $this->location);
            $stmt->bindParam(":temp", $this->temperature);
            $stmt->bindParam(":mois", $this->moisture);
            $stmt->bindParam(":sname", $this->scanname);
            $stmt->bindParam(":kobppm", $this->kobaltppm);
            $stmt->bindParam(":cadppm", $this->cadmiumppm);
            $stmt->bindParam(":kopppm", $this->koperppm);
            $stmt->bindParam(":kwippm", $this->kwikppm);
            $stmt->bindParam(":looppm", $this->loodppm);
            $stmt->bindParam(":zinppm", $this->zinkppm);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "er is iets misgegaan met het maken van het product!" . " " . $e->getMessage();
        }
    }

    /**
     *
     */
    public function scandata($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM waardes WHERE scan_id = :scanid");
        $stmt->bindParam(":scanid", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->waardes_info = $result;
    }

    /**
     * @param $id
     */
    public function read($id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id is geen getal');
        }

        try {
            $stmt = $this->db->prepare("
                           SELECT *
                           FROM waardes
                           WHERE waardes.scan_id = :id
                            ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->waardes_info = $result;
                $this->scan_id = $result['scan_id'];
                $this->date = $result['datum'];
                $this->location = $result['locatie'];
                $this->temperature = $result['temperatuur'];
                $this->moisture = $result['vochtigheid'];
                $this->scanname = $result['naam_scan'];
                $this->kobaltppm = $result['kobalt_ppm'];
                $this->kobalt_warning = $result['kobalt_warning'];
                $this->kobalt_intervene = $result['kobalt_intervene'];
                $this->cadmiumppm = $result['cadmium_ppm'];
                $this->cadmium_warning = $result['cadmium_warning'];
                $this->cadmium_intervene = $result['cadmium_intervene'];
                $this->koperppm = $result['koper_ppm'];
                $this->koper_warning = $result['koper_warning'];
                $this->koper_intervene = $result['koper_intervene'];
                $this->kwikppm = $result['kwik_ppm'];
                $this->kwik_warning = $result['kwik_warning'];
                $this->kwik_intervene = $result['kwik_intervene'];
                $this->loodppm = $result['lood_ppm'];
                $this->lood_warning = $result['lood_warning'];
                $this->lood_intervene = $result['lood_intervene'];
                $this->zinkppm = $result['zink_ppm'];
                $this->zink_warning = $result['zink_warning'];
                $this->zink_intervene = $result['zink_intervene'];
                $this->lat = $result['latitude'];
                $this->lng = $result['longitude'];
            }

        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }

    }

    /**
     * @param $id
     */
    public function update($id)
    {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException('id is geen getal!');
        }
        try {
            $stmt = $this->db->prepare("UPDATE waardes SET kobalt_ppm = :kobppm,
                                                           cadmium_ppm = :cadppm,
                                                           koper_ppm = :kopppm,
                                                           kwik_ppm = :kwippm,
                                                           lood_ppm = :looppm,
                                                           zink_ppm = :zinppm,
                                                           WHERE id= scan_id:");
            $stmt->bindParam(":kobppm", $this->kobaltppm);
            $stmt->bindParam(":cadppm", $this->cadmiumppm);
            $stmt->bindParam(":kopppm", $this->koperppm);
            $stmt->bindParam(":kwippm", $this->kwikppm);
            $stmt->bindParam(":looppm", $this->loodppm);
            $stmt->bindParam(":zinppm", $this->zinkppm);
            $stmt->bindParam(":scan_id", $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM waardes WHERE scan_id= :scanid");
        $stmt->bindParam(':scanid', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->lat;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->lng;
    }

    /**
     * @return mixed
     */
    public function getLastinsertedid()
    {
        return $this->lastinsertedid;
    }

    /**
     * @return int
     */
    public function getScanid()
    {
        return $this->scan_id;
    }

    /**
     * @param $scan_id
     */
    public function setScanid($scan_id)
    {
        $this->scan_id = htmlentities($scan_id);
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $location
     */
    public function setLocation($location)
    {
        $this->location = htmlentities($location);
    }

    /**
 * @return string
 */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature= htmlentities($temperature);
    }

    /**
     * @return string
     */
    public function getMoisture()
    {
        return $this->moisture;
    }

    /**
     * @param $moisture
     */
    public function setMoisture($moisture)
    {
        $this->moisture= htmlentities($moisture);
    }

    /**
     * @return string
     */
    public function getScanName()
    {
        return $this->scanname;
    }

    /**
     * @param $scanname
     */
    public function setScanName($scanname)
    {
        $this->scanname= htmlentities($scanname);
    }

    /**
     * @return int
     */
    public function getKobaltPpm()
    {
        return $this->kobaltppm;
    }

    /**
     * @return int
     */
    public function getKobaltWarning()
    {
        return $this->kobalt_warning;
    }

    /**
     * @return int
     */
    public function getKobaltIntervene()
    {
        return $this->kobalt_intervene;
    }

    /**
 * @return int
 */

    public function getCadmiumPpm()
    {
        return $this->cadmiumppm;
    }

    /**
 * @return int
 */
    public function getCadmiumWarning()
    {
        return $this->cadmium_warning;
    }

 /**
* @return int
*/
    public function getCadmiumIntervene()
    {
        return $this->cadmium_intervene;
    }

/**
* @return int
*/

    public function getKoperPpm()
    {
        return $this->koperppm;
    }

    /**
 * @return int
 */
    public function getKoperWarning()
    {
        return $this->koper_warning;
    }

 /**
* @return int
*/
    public function getKoperIntervene()
    {
        return $this->koper_intervene;
    }

/**
* @return int
*/

    public function getKwikPpm()
    {
        return $this->kwikppm;
    }

    /**
 * @return int
 */
    public function getKwikWarning()
    {
        return $this->kwik_warning;
    }

 /**
 * @return int
 */

    public function getKwikIntervene()
    {
        return $this->kwik_intervene;
    }

 /**
* @return int
*/

    public function getLoodPpm()
    {
        return $this->loodppm;
    }

    /**
    * @return int
    */

   public function getLoodWarning()
   {
       return $this->lood_warning;
   }
   /**
  * @return int
  */

    public function getLoodIntervene()
    {
        return $this->lood_intervene;
    }

    /**
 * @return int
 */
    public function getZinkPpm()
    {
        return $this->zinkppm;
    }

    /**
    * @return int
    */
    public function getZinkWarning()
    {
        return $this->zink_warning;
    }

    /**
    * @return int
    */
    public function getZinkIntervene()
    {
        return $this->zink_intervene;
    }

    /**
     * @return array
     */
    public function getProductInfo()
    {
        return $this->scan_info;
    }


    /**
     * @param int $kobaltppm
     */
    public function setKobaltPpm($kobaltppm)
    {
        $this->kobaltppm = htmlentities($kobaltppm);
    }
    /**
     * @param int $kobalt_warning
     */
    public function setKobaltWarning($kobalt_warning)
    {
        $this->kobalt_warning = htmlentities($kobalt_warning);
    }
    /**
     * @param int $kobalt_intervene
     */
    public function setKobaltIntervene($kobalt_intervene)
    {
        $this->kobalt_intervene = htmlentities($kobalt_intervene);
    }


    /**
     * @param int $cadmiumppm
     */
    public function setCadmiumPpm($cadmiumppm)
    {
        $this->cadmiumppm = htmlentities($cadmiumppm);
    }
    /**
     * @param int $cadmium_warning
     */
    public function setCadmiumWarning($cadmium_warning)
    {
        $this->cadmium_warning = htmlentities($cadmium_warning);
    }
    /**
     * @param int $cadmium_intervene
     */
    public function setCadmiumIntervene($cadmium_intervene)
    {
        $this->cadmium_intervene = htmlentities($cadmium_intervene);
    }

    /**
     * @param int $loodppm
     */
    public function setLoodPpm($loodppm)
    {
        $this->loodppm = htmlentities($loodppm);
    }
    /**
     * @param int $lood_warning
     */
    public function setLoodWarning($lood_warning)
    {
        $this->lood_warning = htmlentities($lood_warning);
    }
    /**
     * @param int $lood_intervene
     */
    public function setLoodIntervene($lood_intervene)
    {
        $this->lood_intervene = htmlentities($lood_intervene);
    }

    /**
     * @param int $koperppm
     */
    public function setKoperPpm($koperppm)
    {
        $this->koperppm = htmlentities($koperppm);
    }
    /**
     * @param int $koper_warning
     */
    public function setKoperWarning($koper_warning)
    {
        $this->koper_warning = htmlentities($koper_warning);
    }
    /**
     * @param int $koper_intervene
     */
    public function setKoperIntervene($koper_intervene)
    {
        $this->koper_intervene = htmlentities($koper_intervene);
    }

    /**
     * @param int $zinkppm
     */
    public function setZinkPpm($zinkppm)
    {
            $this->zinkppm = htmlentities($zinkppm);
    }
    /**
     * @param int $zink_warning
     */
    public function setZinkWarning($zink_warning)
    {
            $this->zink_warning = htmlentities($zink_warning);
    }
    /**
     * @param int $zink_intervene
     */
    public function setZinkIntervene($zink_intervene)
    {
            $this->zink_intervene = htmlentities($zink_intervene);
    }

    /**
     * @param int $kwikppm
     */
    public function setKwikPpm($kwikppm)
    {
        $this->kwikppm = htmlentities($kwikppm);
    }
    /**
     * @param int $kwik_warning
     */
    public function setKwikWarning($kwik_warning)
    {
        $this->kwik_warning = htmlentities($kwik_warning);
    }
    /**
     * @param int $kwik_intervene
     */
    public function setKwikIntervene($kwik_intervene)
    {
        $this->kwik_intervene = htmlentities($kwik_intervene);
    }
}
