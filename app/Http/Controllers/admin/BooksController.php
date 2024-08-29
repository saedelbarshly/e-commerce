<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreBook;
use Illuminate\Http\Request;
use App\Books;
use App\BookReviews;
use Response;

class BooksController extends Controller
{
    //
    public function index(Type $var = null)
    {
        $books = Books::orderBy('id','desc')->paginate(25);
        return view('AdminPanel.books.index',[
            'title' => trans('common.books'),
            'active' => 'books',
            'books' => $books,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.books')
                ]
            ]
        ]);
    }
    public function create()
    {
        return view('AdminPanel.books.create',[
            'active' => 'books',
            'title' => trans('common.books'),
            'breadcrumbs' => [
                                [
                                    'url' => route('admin.books'),
                                    'text' => trans('common.books')
                                ],
                                [
                                    'url' => '',
                                    'text' => trans('common.CreateNew')
                                ]
                            ]
        ]);
    }

    public function store(StoreBook $request)
    {

        $data = $request->except(['_token','backPage','photo']);

        $book = Books::create($data);
        if ($request->photo != '') {
            $book['photo'] = upload_image_without_resize('books/'.$book->id , $request->photo );
            $book->update();
        }
        if ($request->backPage != '') {
            $book['backPage'] = upload_image_without_resize('books/'.$book->id , $request->backPage );
            $book->update();
        }
        if ($book->update($data)) {
            return redirect()->route('admin.books')
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }
        
    }

    public function edit($id)
    {
        $book = Books::find($id);
        return view('AdminPanel.books.edit',[
            'active' => 'books',
            'title' => trans('common.books'),
            'book' => $book,
            'breadcrumbs' => [
                                [
                                    'url' => route('admin.books'),
                                    'text' => trans('common.books')
                                ],
                                [
                                    'url' => '',
                                    'text' => trans('common.edit')
                                ]
                            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $update = Books::find($id);
        $data = $request->except(['_token','backPage','photo']);
        // return $data;
        if ($request->photo != '') {
            if ($update->photo != '') {
                delete_image('books/'.$id , $update->photo);
            }
            $data['photo'] = upload_image_without_resize('books/'.$id , $request->photo );
        }
        if ($request->backPage != '') {
            if ($update->backPage != '') {
                delete_image('books/'.$id , $update->backPage);
            }
            $data['backPage'] = upload_image_without_resize('books/'.$id , $request->backPage );
        }
        if (!isset($data['hardCopy'])) {
            $data['hardCopy'] = '0';
        }
        if (!isset($data['pdfCopy'])) {
            $data['pdfCopy'] = '0';
        }
        if (!isset($data['available'])) {
            $data['available'] = '0';
        }

        $update = $update->update($data);
        if ($update) {
            return redirect()->route('admin.books')
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }
        
    }

    public function delete($id)
    {
        $book = Books::find($id);
        delete_folder('books/'.$id);
        if ($book->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }



    
    public function reviews($id)
    {
        $book = Books::find($id);
        $reviews = BookReviews::where('book_id',$id)->paginate(25);
        return view('AdminPanel.books.reviews',[
            'active' => 'books',
            'title' => trans('common.books'),
            'book' => $book,
            'reviews' => $reviews,
            'breadcrumbs' => [
                                [
                                    'url' => route('admin.books'),
                                    'text' => trans('common.books')
                                ],
                                [
                                    'url' => '',
                                    'text' => trans('common.reviews').': '.$book->name_ar
                                ]
                            ]
        ]);
    }


    public function reviewAction(Request $request, $id, $review_id, $action)
    {
        $review = BookReviews::find($review_id);
        // return $data;
        if ($action == 'delete') {
            $review = $review->delete();
            return redirect()->route('admin.books')
                            ->with('success',trans('common.successMessageText'));
        }
        if ($action == 'accept') {
            $data = ['status'=>1];
        } else {
            $data = ['status'=>0];
        }
        
        $review->book->update(['review_sum'=>$review->book->reviewsTotal()*5]);
        $review = $review->update($data);
        if ($review) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }
        
    }


    public function booksBulkDelete(Request $request)
    {
        if ($request['books'] == '') {
            return redirect()->route('admin.books')
                            ->with('faild',trans('common.selectBooksFirst'));
        }
        foreach ($request['books'] as $key => $value) {
            $book = Books::find($value);
            if ($book != '') {
                delete_folder('books/'.$value);
                $book->delete();
            }
        }
        return redirect()->route('admin.books')
                        ->with('success',trans('common.successMessageText'));
    }
}
