import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import { Router, ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'AddRestComponent',
  templateUrl: './addrest.html',
})
export class AddRestComponent {
  http: Http;
  router: Router;
  postResponse: Response;
  route: ActivatedRoute;
  games: Object[];
  companies: Object[];
  genres: Object[];
  languages: Object[];
  addRestForm = new FormGroup({
    game_id: new FormControl(),
    company_id: new FormControl(),
    genre_id: new FormControl(),
    language_id: new FormControl()
  });

  constructor(route: ActivatedRoute, http: Http, router: Router) {
    this.http = http;
    this.router = router;
    this.route = route;
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));
    http.get('http://localhost/gamedream/getaddgames.php', {headers: headers})
    .map(res => res.json()).share()
    .subscribe(
      data => {
        this.games = data.games;
      },
      err => {
        this.router.navigate(['./']);
      }
    );

    http.get('http://localhost/gamedream/getgenres.php', {headers: headers})
    .map(res => res.json()).share()
    .subscribe(
      data => {
        this.genres = data.genres;
      },
      err => {
        this.router.navigate(['./']);
      }
    );

    http.get('http://localhost/gamedream/getcompanies.php', {headers: headers})
    .map(res => res.json()).share()
    .subscribe(
      data => {
        this.companies = data.companies;
      },
      err => {
        this.router.navigate(['./']);
      }
    );

    http.get('http://localhost/gamedream/getlanguages.php', {headers: headers})
    .map(res => res.json()).share()
    .subscribe(
      data => {
        this.languages = data.languages;
      },
      err => {
        this.router.navigate(['./']);
      }
    );
  }

  onAddRest(): void {
   var data = "game_id=" + this.addRestForm.value.game_id +
   "&company_id=" + this.addRestForm.value.company_id +
   "&genre_id=" + this.addRestForm.value.genre_id +
   "&language_id=" + this.addRestForm.value.language_id;
   var headers = new Headers();
   headers.append('Content-Type', 'application/x-www-form-urlencoded');
   headers.append("token",localStorage.getItem("token"));
   this.http.post('http://localhost/gamedream/addrest.php',data,{headers:headers})
   .map(res => res)
   .subscribe(
     data => this.postResponse = data,
     err => alert(JSON.stringify(err)),
     () => {
       if(this.postResponse["_body"].indexOf("error") === -1){
         this.router.navigate(['./allgames']);
       }else{
         alert("Neuspesno dodavanje igrice");
       }
     }
   );
 }
}
