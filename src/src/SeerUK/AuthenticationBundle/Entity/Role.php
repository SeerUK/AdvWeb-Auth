<?php

/**
 * Advanced Web Development - Authorisation
 *
 * @author  Elliot Wright <wright.elliot@gmail.com>
 * @since   2014
 * @package AdvWeb-Auth
 */

namespace SeerUK\AuthenticationBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * SeerUK\AuthenticationBundle\Entity\Role
 *
 * @ORM\Table(name="Role")
 * @ORM\Entity()
 */
class Role implements RoleInterface, \Serializable
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    protected $name;

    /**
     * @ORM\Column(name="role", type="string", length=20, unique=true)
     */
    protected $role;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="roles")
     * @JoinTable(name="UserRole",
     *     joinColumns={@JoinColumn(name="roleId", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="userId", referencedColumnName="id")}
     * )
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @inheritDoc
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @inheritDoc
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->name,
            $this->role,
            $this->users
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->role,
            $this->users
        ) = unserialize($serialized);
    }
}