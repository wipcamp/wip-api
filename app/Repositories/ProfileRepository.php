<?php
namespace App\Repositories;
use App\Models\Profile;
use App\Models\ProfileRegistrant;

class ProfileRepository implements ProfileRepositoryInterface {
  protected $profiles;

  public function __construct(){
    $this->profiles = new Profile;
  }

  public function create($data) {
    $this->profiles = new Profile($data);
    $result = $this->profiles->save();
    if ($result) {
      $profilesRegistrant = new ProfileRegistrant($data);
      $result = $this->profiles->profile_registrant()->save($profilesRegistrant);
    }
    return json_encode(['result' => $result]);
  }
  
  public function update($data) {
    $this->profiles = new Profile;
    $result = $this->profiles
      ->where('user_id', $data['user_id'])
      ->update([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'first_name_en' => $data['first_name_en'],
        'last_name_en' => $data['last_name_en'],
        'nickname' => $data['nickname'],
        'gender_id' => $data['gender_id'],
        'citizen_id' => $data['citizen_id'],
        'religion_id' => $data['religion_id'],
        'birth_at' => $data['birth_at'],
        'blood_group' => $data['blood_group'],
        'congenital_diseases' => $data['congenital_diseases'],
        'allergic_foods' => $data['allergic_foods'],
        'congenital_drugs' => $data['congenital_drugs']
      ]);
    if ($result) {
      $profilesRegistrant = new ProfileRegistrant;
      $result = $this->profiles
        ->profile_registrant()
        ->where('user_id', $data['user_id'])
        ->update([
            'addr_prov' => $data['addr_prov'],
            'addr_dist' => $data['addr_dist'],
            'telno_personal' => $data['telno_personal'],
            'edu_name' => $data['edu_name'],
            'edu_lv' => $data['edu_lv'],
            'edu_major' => $data['edu_major'],
            'edu_gpax' => $data['edu_gpax'],
            'known_via' => $data['known_via'],
            'activities' => $data['activities'],
            'skill_computer' => $data['skill_computer'],
            'past_camp' => $data['past_camp'],
            'parent_relation' => $data['parent_relation'],
            'telno_parent' => $data['telno_parent']
        ]);
    }
    return json_encode(['result' => $result ? true : false]);  
  }
}