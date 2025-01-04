<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $agencyName
 * @property string|null $agencyAddress
 * @property string $agencyCity
 * @property string $memName
 * @property string $memNumber
 * @property string $agentName
 * @property string $agentminName
 * @property string $agentlastName
 * @property int $cnicNum
 * @property string $cnicExp
 * @property string $agentProfile
 * @property string|null $agentCertificate
 * @property string|null $cnicVerify
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property string $password
 * @property string $agentEmail
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Property> $properties
 * @property-read int|null $properties_count
 * @method static \Illuminate\Database\Eloquent\Builder|Agent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agent query()
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereAgencyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereAgencyCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereAgencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereAgentCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereAgentEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereAgentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereAgentProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereAgentlastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereAgentminName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereCnicExp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereCnicNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereCnicVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereMemName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereMemNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agent whereUpdatedAt($value)
 */
	class Agent extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $property_id
 * @property int $floorNo
 * @property int $suitNo
 * @property int $areaSqft
 * @property int $rateSqft
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Property|null $property
 * @method static \Illuminate\Database\Eloquent\Builder|Floor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereAreaSqft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereFloorNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereRateSqft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereSuitNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereUpdatedAt($value)
 */
	class Floor extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $agent_id
 * @property string $name
 * @property string $address
 * @property string $plotSize
 * @property string $dimFront
 * @property string $dimWidth
 * @property string $totalSize
 * @property string $leasedArea
 * @property string $nearestLand
 * @property string $corner
 * @property int $parkingcap
 * @property string $demandSqft
 * @property string $absValue
 * @property string $agentname
 * @property int $agentcontact
 * @property string $agentdetail
 * @property string $contactPerson
 * @property string|null $file_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Agent|null $agent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Floor> $floors
 * @property-read int|null $floors_count
 * @method static \Illuminate\Database\Eloquent\Builder|Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property query()
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAbsValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAgentcontact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAgentdetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAgentname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCorner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereDemandSqft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereDimFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereDimWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereLeasedArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereNearestLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereParkingcap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePlotSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereTotalSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereUpdatedAt($value)
 */
	class Property extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $property_id
 * @property string $file_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Property $property
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImages whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImages wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyImages whereUpdatedAt($value)
 */
	class PropertyImages extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property mixed $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|adminModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|adminModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|adminModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|adminModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|adminModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|adminModel whereUpdatedAt($value)
 */
	class adminModel extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|userModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|userModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|userModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|userModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|userModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|userModel whereUpdatedAt($value)
 */
	class userModel extends \Eloquent {}
}

