import {Component, OnInit, Directive} from "@angular/core";
import {UserService} from "./user.service";
import {User} from "./user.model";
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import { Router, ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
})

export class UserComponent implements OnInit {
  http: Http;
  router: Router;
  postResponse: Response;
  route: ActivatedRoute;
  user: User;
  change: boolean = false;
  updateProfileForm = new FormGroup({
    name: new FormControl(),
    surname: new FormControl(),
    avatar: new FormControl(),
    birth_date: new FormControl(),
    country: new FormControl()
  });

  constructor(private userService: UserService, route: ActivatedRoute, http: Http, router: Router) {
    this.http = http;
    this.router = router;
    this.route = route;
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));
  }

  ngOnInit() {
    this.loadUser();
  }

  loadUser() {
    this.userService.getUser()
    .subscribe(
      data => {
        this.user = data;
      });
  }

  /*updateProfile(){
    this.userService.updateProfile(this.user.avatar, this.user.birth_date, this.user.country);
  }*/

  updateProfile(): void {
    var data = "name=" + this.updateProfileForm.value.name + "&surname=" + this.updateProfileForm.value.surname +
    "&avatar=" + this.updateProfileForm.value.avatar + "&birth_date=" + this.updateProfileForm.value.birth_date + "&country=" + this.updateProfileForm.value.country;
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append("token",localStorage.getItem("token"));
    this.http.post('http://localhost/gamedream/updateprofile.php',data,{headers:headers})
    .map(res => res)
    .subscribe(
      data => this.postResponse = data,
      err => alert(JSON.stringify(err)),
      () => {
        if(this.postResponse["_body"].indexOf("error") === -1){
          this.router.navigate(['./user?refresh=1']);
        }else{
          alert("Neuspesno updejtovanje profila");
        }
      }
    );
  }

  logout() {
    this.userService.logout();
  }

}
