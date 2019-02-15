import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Game} from "./game.model";
import {Http, Response} from "@angular/http";
import {Router} from '@angular/router';

import "rxjs/add/operator/map";
import "rxjs/add/operator/do";
import "rxjs/add/operator/catch";
import {apiUrl, SharedService} from "../shared/shared.service";

@Injectable()
export class GameService {
  private url = apiUrl;

    constructor(private http: Http,
      private sharedService: SharedService,
      private router: Router) {
    }

    getGames(): Observable<Game[]> {
      return this.http.get(this.url + 'getgames.php')
        .map((response: Response) => <Game[]> response.json().games);
    }

    getUserGames(): Observable<Game[]> {
      let headers = this.sharedService.getHeaders();
      return this.http.get(this.url + 'getusergames.php', {headers: headers})
          .map((response: Response) => <Game[]> response.json());
    }

    getGenreGames(id: number): Observable<Game[]>{
      return this.http.get(this.url + 'getgenregames.php?id='+id)
        .map((response: Response) => <Game[]> response.json().games);
    }

    getGame(id: number): Observable<Game> {
      return this.getGames()
        .map((games: Game[]) => games.find(game => game.id === id));
    }

    getCompanies(): Observable<Game[]> {
      return this.http.get(this.url + 'getcompanies.php')
        .map((response: Response) => <Game[]> response.json().genres);
    }

    getLanguages(): Observable<Game[]> {
        return this.http.get(this.url + 'getlanguages.php')
            .map((response: Response) => <Game[]> response.json().genres);
    }

    getGenres(): Observable<Game[]> {
      return this.http.get(this.url + 'getgenres.php')
        .map((response: Response) => <Game[]> response.json().genres);
    }

    viewGame(id: Number){
      this.router.navigate(['/game', id]);
    }

    addGame(name: string, description: string, votes: string,
    cover: string, version: string, rating: string, release_date: string,
    size: string, price: number){
      let data = "name=" + name + "&description=" + description + "&votes=" + votes +
      "&cover=" + cover + "&version=" + version + "&rating=" + rating +
      "&release_date=" + release_date + "&size=" + size + "&price=" + price;
      let headers = this.sharedService.getHeaders();
      this.http.post(this.url + 'addgame.php', data, {headers: headers})
          .map(res => res)
          .subscribe(data => data);
    }

    addRest(game_id: number, company_id: number, genre_id: number, language_id: number){
      let data = 'game_id=' + game_id + 'company_id=' + company_id +
      'genre_id=' + genre_id + 'language_id=' + language_id;
      let headers = this.sharedService.getHeaders();
      this.http.post(this.url + 'addrest.php', data, {headers: headers})
        .map(res => res)
        .subscribe(data => data)
    }
}
