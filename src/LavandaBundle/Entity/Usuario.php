<?php

namespace LavandaBundle\Entity;


use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 */
class Usuario implements UserInterface, AdvancedUserInterface, \Serializable
{
    /**
     * @var integer
     */
    private $idusuario;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $role;

    /**
     * @var \DateTime
     */
    private $createdAt;


    /**
     * Get idusuario
     *
     * @return integer
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Usuario
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Usuario
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * @var boolean
     */
    private $isactive;


    /**
     * Set isactive
     *
     * @param boolean $isactive
     *
     * @return Usuario
     */
    public function setIsactive($isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }

    /**
     * Get isactive
     *
     * @return boolean
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return $this->isactive;
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize(array(
            $this->idusuario,
            $this->username,
            $this->password,
            $this->role,
            $this->isactive
        ));
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list(
            $this->idusuario,
            $this->username,
            $this->password,
            $this->role,
            $this->isactive
            ) = unserialize($serialized);
    }

    /**
     * Sets the last login time.
     *
     * @param \DateTime|null $time
     *
     * @return static
     */
    public function setLastLogin(\DateTime $time = null)
    {
        // TODO: Implement setLastLogin() method.
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the user unique id.
     *
     * @return mixed
     */
    public function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * Gets the canonical username in search and sort queries.
     *
     * @return string
     */
    public function getUsernameCanonical()
    {
        // TODO: Implement getUsernameCanonical() method.
    }

    /**
     * Sets the canonical username.
     *
     * @param string $usernameCanonical
     *
     * @return static
     */
    public function setUsernameCanonical($usernameCanonical)
    {
        // TODO: Implement setUsernameCanonical() method.
    }

    /**
     * @param string|null $salt
     *
     * @return static
     */
    public function setSalt($salt)
    {
        // TODO: Implement setSalt() method.
    }

    /**
     * Gets email.
     *
     * @return string
     */
    public function getEmail()
    {
        // TODO: Implement getEmail() method.
    }

    /**
     * Sets the email.
     *
     * @param string $email
     *
     * @return static
     */
    public function setEmail($email)
    {
        // TODO: Implement setEmail() method.
    }

    /**
     * Gets the canonical email in search and sort queries.
     *
     * @return string
     */
    public function getEmailCanonical()
    {
        // TODO: Implement getEmailCanonical() method.
    }

    /**
     * Sets the canonical email.
     *
     * @param string $emailCanonical
     *
     * @return static
     */
    public function setEmailCanonical($emailCanonical)
    {
        // TODO: Implement setEmailCanonical() method.
    }

    /**
     * Sets the plain password.
     *
     * @param string $password
     *
     * @return static
     */
    public function setPlainPassword($password)
    {
        // TODO: Implement setPlainPassword() method.
    }

    /**
     * Tells if the the given user has the super admin role.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        // TODO: Implement isSuperAdmin() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * Gets the plain password.
     *
     * @return string
     */
    public function getPlainPassword()
    {
        // TODO: Implement getPlainPassword() method.
    }

    /**
     * @param bool $boolean
     *
     * @return static
     */
    public function setEnabled($boolean)
    {
        // TODO: Implement setEnabled() method.
    }

    /**
     * Sets the super admin status.
     *
     * @param bool $boolean
     *
     * @return static
     */
    public function setSuperAdmin($boolean)
    {
        // TODO: Implement setSuperAdmin() method.
    }

    /**
     * Gets the confirmation token.
     *
     * @return string|null
     */
    public function getConfirmationToken()
    {
        // TODO: Implement getConfirmationToken() method.
    }

    /**
     * Sets the confirmation token.
     *
     * @param string|null $confirmationToken
     *
     * @return static
     */
    public function setConfirmationToken($confirmationToken)
    {
        // TODO: Implement setConfirmationToken() method.
    }

    /**
     * Sets the timestamp that the user requested a password reset.
     *
     * @param null|\DateTime $date
     *
     * @return static
     */
    public function setPasswordRequestedAt(\DateTime $date = null)
    {
        // TODO: Implement setPasswordRequestedAt() method.
    }

    /**
     * Checks whether the password reset request has expired.
     *
     * @param int $ttl Requests older than this many seconds will be considered expired
     *
     * @return bool
     */
    public function isPasswordRequestNonExpired($ttl)
    {
        // TODO: Implement isPasswordRequestNonExpired() method.
    }

    /**
     * Never use this to check if this user has access to anything!
     *
     * Use the AuthorizationChecker, or an implementation of AccessDecisionManager
     * instead, e.g.
     *
     *         $authorizationChecker->isGranted('ROLE_USER');
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        // TODO: Implement hasRole() method.
    }

    /**
     * Sets the roles of the user.
     *
     * This overwrites any previous roles.
     *
     * @param array $roles
     *
     * @return static
     */
    public function setRoles(array $roles)
    {
        // TODO: Implement setRoles() method.
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
       return array($this->getRole());
    }

    /**
     * Adds a role to the user.
     *
     * @param string $role
     *
     * @return static
     */
    public function addRole($role)
    {
        // TODO: Implement addRole() method.
    }

    /**
     * Removes a role to the user.
     *
     * @param string $role
     *
     * @return static
     */
    public function removeRole($role)
    {
        // TODO: Implement removeRole() method.
    }

    public function __toString()
    {
        return $this->username;
    }


    /**
     * @var string
     */
    private $rutaimagen;

    /**
     * @var string
     */
    private $nombreimagen;


    /**
     * Set rutaimagen
     *
     * @param string $rutaimagen
     *
     * @return Usuario
     */
    public function setRutaimagen($rutaimagen)
    {
        $this->rutaimagen = $rutaimagen;

        return $this;
    }

    /**
     * Get rutaimagen
     *
     * @return string
     */
    public function getRutaimagen()
    {
        return $this->rutaimagen;
    }

    /**
     * Set nombreimagen
     *
     * @param string $nombreimagen
     *
     * @return Usuario
     */
    public function setNombreimagen($nombreimagen)
    {
        $this->nombreimagen = $nombreimagen;

        return $this;
    }

    /**
     * Get nombreimagen
     *
     * @return string
     */
    public function getNombreimagen()
    {
        return $this->nombreimagen;
    }
    /**
     * @var \LavandaBundle\Entity\Sucursal
     */
    private $idsucursal;


    /**
     * Set idsucursal.
     *
     * @param \LavandaBundle\Entity\Sucursal|null $idsucursal
     *
     * @return Usuario
     */
    public function setIdsucursal(\LavandaBundle\Entity\Sucursal $idsucursal = null)
    {
        $this->idsucursal = $idsucursal;

        return $this;
    }

    /**
     * Get idsucursal.
     *
     * @return \LavandaBundle\Entity\Sucursal|null
     */
    public function getIdsucursal()
    {
        return $this->idsucursal;
    }
}
