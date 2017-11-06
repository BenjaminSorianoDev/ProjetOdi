<?php

namespace AppBundle\Entity;

/**
 * Identification
 */
class Identification
{
    private $pseudo;
    private $mdp;

      /**
       * Set pseudo
       *
       * @param string $pseudo
       *
       * @return Identification
       */
       
      public function setPseudo($pseudo)
      {
          $this->pseudo = $pseudo;

          return $this;
      }

      /**
       * Get pseudo
       *
       * @return string
       */
      public function getPseudo()
      {
          return $this->pseudo;
      }

      /**
       * Set mdp
       *
       * @param string $mdp
       *
       * @return Identification
       */
      public function setMdp($mdp)
      {
          $this->mdp = $mdp;

          return $this;
      }

      /**
       * Get mdp
       *
       * @return string
       */
      public function getMdp()
      {
          return $this->mdp;
      }
}
