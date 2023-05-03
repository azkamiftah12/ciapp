<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }

    public function view($slug = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);
        $data2 = [
            'newssuggest'  => $model->getNews(),
        ];

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view', $data2)
            . view('templates/footer');
    }

    public function delete($id = null)
    {
        $model = new NewsModel();
        $model->delete($id);
        session()->setFlashdata('dangermessage', 'Data Berhasil dihapus.');
        return redirect()->route('news');
    }

    public function create()
    {
        helper('form');

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['title', 'body', 'coverimg']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
            'coverimg' => [
                'rules' => 'uploaded[coverimg]|is_image[coverimg]|mime_in[coverimg,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'pilih cover image',
                    'is_image' => 'file bukan gambar',
                    'mime_in' => 'file bukan gambar'
                ]
            ]
        ])) {
            // The validation fails, so returns the form.
            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }


        $model = model(NewsModel::class);

        $filecoverimg = $this->request->getFile('coverimg');
        //pindahkan file ke folder img yang di public
        $filecoverimg->move('img');
        //ambil nama file coverimg
        $namacoverimg = $filecoverimg->getName();

        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
            'coverimg' => $namacoverimg
        ]);

        session()->setFlashdata('successmessage', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/news');
    }

    public function update($id = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNew($id);

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $id);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/update')
            . view('templates/footer');
    }

    public function edit($id)
    {
        helper('form');

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', ['title' => 'Update a news item'])
                . view('news/update')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['id','title', 'body', 'coverimg']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return view('templates/header', ['title' => 'Update a news item'])
                . view('news/update')
                . view('templates/footer');
        }

        $filecoverimg = $this->request->getFile('coverimg');
        //pindahkan file ke folder img yang di public
        $filecoverimg->move('img');
        //ambil nama file coverimg
        $namacoverimg = $filecoverimg->getName();

        $id = $post['id'];

        $data = [
            'title' => $post['title'],
            'slug' => url_title($post['title'], '-', true),
            'body'  => $post['body'],
            'coverimg' => $namacoverimg
        ];

        $model = model(NewsModel::class);

        $model->update($id, $data);

        session()->setFlashdata('warningmessage', 'Data Berhasil Diupdate.');
        return redirect()->route('news');
    }
}