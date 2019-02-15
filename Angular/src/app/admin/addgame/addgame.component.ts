import {Game} from "../../game/game.model";
import {GameService} from "../../game/game.service";
import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import { Router, ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'AddGameComponent',
  templateUrl: './addgame.component.html',
})
export class AddGameComponent{
  http: Http;
  router: Router;
  postResponse: Response;
  route: ActivatedRoute;
  games: Object[];
  addGameForm = new FormGroup({
    name: new FormControl(),
    description: new FormControl(),
    votes: new FormControl(),
    cover: new FormControl(),
    version: new FormControl(),
    rating: new FormControl(),
    release_date: new FormControl(),
    size: new FormControl(),
    price: new FormControl()
  });

  constructor(route: ActivatedRoute, http: Http, router: Router) {
    this.http = http;
    this.router = router;
    this.route = route;
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));
}

onAddGame(): void {
  var data = "name=" + this.addGameForm.value.name + "&description=" + this.addGameForm.value.description + "&votes=" + this.addGameForm.value.votes +
  "&cover=" + this.addGameForm.value.cover + "&version=" + this.addGameForm.value.version + "&rating=" + this.addGameForm.value.rating +
  "&release_date=" + this.addGameForm.value.release_date + "&size=" + this.addGameForm.value.size + "&price=" + this.addGameForm.value.price;
  var headers = new Headers();
  headers.append('Content-Type', 'application/x-www-form-urlencoded');
  headers.append("token",localStorage.getItem("token"));
  this.http.post('http://localhost/gamedream/addgame.php',data,{headers:headers})
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
