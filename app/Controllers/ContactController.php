<?php

namespace App\Controllers;

use App\Http\Paginator;
use App\Controllers\BaseController;
use App\Http\Response;
use App\Models\City;
use App\Models\District;
use App\Models\User;
use App\Models\Contact;
use App\Models\Ward;


class ContactController extends BaseController
{

    public function contact()
    {
        $user = auth();
        $contact = null;
        if ($user == null) {
            $this->redirect('/login');
        } else {
            $cities = City::all();
            $data = [
                'cities' => $cities,
                'contact' => $contact
            ];
            return $this->render('contact/contact', $data);
        }
    }
    //Using ajax to render city and district
    public function contactWard()
    {
        if (isset($_GET['cityId'])) {
            $cityId = $_GET['cityId'];
            $districts = District::where(['city_id' => $cityId])->get();
            echo '<option value="0" selected>Select your district</option>';
            if ($districts != null) {
                foreach ($districts as $district) {
                    echo '<option value="' . $district->id . '">' . $district->id . ' - ' . $district->name . '</option>';
                }
            }
        }

        if (isset($_GET['districtId'])) {
            $districtId = $_GET['districtId'];
            $wards = Ward::where(['district_id' => $districtId])->get();
            echo '<option value="0" selected>Select your ward</option>';
            if ($wards != null) {
                foreach ($wards as $ward) {
                    echo '<option value="' . $ward->id . '">' . $ward->id . ' - ' . $ward->name . '</option>';
                }
            }
        }
    }

    public function addContact()
    {
        $user = auth();
        $params['user_id'] = $user->id;
        $params['ward_id'] = $_POST['ward_id'];
        $params['address'] = $_POST['address'];
        $params['phone'] = $_POST['phone'];
        $params['email'] = $_POST['email'];
        $cities = City::all();

        $contact = new Contact();
        $contact->fill($params);

        if ($contact->validate($params)) {


            if ($contact->save()) {
                session()->setFlash(\FLASH::SUCCESS, "Congratulations, your contact has been created successfully.");
                $data = [
                    'cities' => $cities,
                    'contact' => $contact,
                ];
                return $this->render('contact/contact', $data);
            }

            $contact->errors['failed'] = 'Add contact failed. Something went wrong, please try again.';
        }
        $data = [
            'cities' => $cities,
            'errors' => $contact->errors,
            'contact' => $contact,
        ];
        return $this->render('contact/contact', $data);
    }

    public function showContactList()
    {
        $user = auth();
        if ($user == null) {
            $this->redirect('/login');
        } else {
            $contacts = Contact::where(['user_id' => $user->id])->paginate($this->getPerPage());
            $total = Contact::where(['user_id' => $user->id])->count();

            $paginator = new Paginator($this->request, $contacts, $total);

            $paginator->onEachSide(2);

            // $data = [
            //     'contacts' => $contacts,
            //     'paginator' => $paginator
            // ];

            if ($this->request->ajax()) {
                $html = $this->view->render('contact/contact-list',  [
                    'contacts' => $contacts,
                    'paginator' => $paginator
                ]);

                return $this->json(['data' => $html]);
            }

            return $this->render('contact/contact-list',  [
                'contacts' => $contacts,
                'paginator' => $paginator
            ]);
        }
    }

    public function deleteContact()
    {
        $id = $this->request->post('contact_id');
        $contact = Contact::find($id);

        if ($this->request->ajax()) {
            if ($contact) {
                if ($contact->delete()) {
                    return $this->json(
                        [
                            'message' => $contact->name . ' has been deleted successfully.'
                        ],
                        Response::HTTP_OK
                    );
                } else {
                    return $this->json(
                        [
                            'message' => 'Unable to delete contact$contact'
                        ],
                        Response::HTTP_BAD_REQUEST
                    );
                }
            }
            return $this->json(
                [
                    'message' => 'Contact ID does not exist!'
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
