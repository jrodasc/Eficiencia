<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;

use App\Submenus;
use DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(1500);
        return view('roles.index',compact('roles'))->with('i', ($request->input('page', 1) - 1) * 1500);
    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
        //$permission = Permission::get();
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            
        ]);

        
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();


        foreach ($request->input('permission') as $key => $value) {
            $role->permisos()->attach($value);

        }

        return redirect()->route('roles.index')->with('success','Rol creado correctamente');
    }

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")->where("permission_role.role_id",$id)->get();
        return view('roles.show',compact('role','rolePermissions'));
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        /*$menu = Menu::where("menus.menu_id","=","0")->get(); 
        $submenu = Menu::where("menus.menu_id","<>","0")->get(); */
        
        $rolePermisos = DB::table("permission_role")->where("permission_role.role_id",$id)->pluck('permission_role.permission_id')->toArray();
        /*$roleMenus = Menu::join("role_menu","role_menu.menu_id","=","menus.id")->where("role_menu.role_id",$id)->get();*/
       
       
        return view('roles.edit',compact('role','permission','rolePermisos','submenu'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'display_name' => 'required',
            'description' => 'required',
            
        ]);


        $role = Role::find($id);
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        DB::table("permission_role")->where("permission_role.role_id",$id)->delete();

        foreach ($request->input('permission') as $key => $value) {
            $role->permisos()->attach($value);

        }
       

        return redirect()->route('roles.index')->with('success','Rol guardado correctamente');
    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')->with('success','Rol borrado correctamente');
    }
}
