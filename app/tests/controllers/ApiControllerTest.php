<?php

class ApiControllerTest extends TestCase {

    public function setUp()
    {
        parent::setUp();

        $tag_data = array(
            array('name' => 'section'),
            array('name' => 'ランディング'),
            array('name' => 'ビジネス'),
            array('name' => 'テスト'),
            array('name' => 'cols'),
        );
        $snippet_data = array(
            array(
                'title' => 'ランディングページ',
                'note' => 'ビジネス向け',
                'body' => ":::section\n\nはじめましてー\n\n---align: center\nvalign: middle\n:::\n",
                'category_id' => 1,
                'tags' => array(1, 2, 3),
            ),
            array(
                'title' => 'テストページ',
                'note' => 'おちゃら',
                'body' => ":::cols\n\n1カラム\n\n===\n\n2カラム\n\n===\n\n3カラム\n\n:::\n",
                'category_id' => 1,
                'tags' => array(4, 5),
            ),
            array(
                'title' => 'アイキャッチ',
                'note' => '目で殺す',
                'body' => ":::section\n\# eyecatch\n\n:::\n",
                'category_id' => 2,
                'tags' => array(1),
            ),
        );
        $snippet_tag_data = array(
            array('snippet_id' => 1, 'tag_id' => 1),
            array('snippet_id' => 1, 'tag_id' => 2),
            array('snippet_id' => 1, 'tag_id' => 3),
            array('snippet_id' => 2, 'tag_id' => 4),
            array('snippet_id' => 2, 'tag_id' => 5),
            array('snippet_id' => 3, 'tag_id' => 1),
        );

        DB::table('tags')->truncate();
        foreach ($tag_data as $row)
        {
            $tag = new Tag($row);
            $tag->save();
        }

        DB::table('snippets')->truncate();
        foreach ($snippet_data as $row)
        {
            $snippet = new Snippet($row);
            $snippet->save();
            $snippet->tags()->sync($row['tags']);
        }

    }

  	/**
  	 * A basic functional test example.
  	 *
  	 * @return void
  	 */
  	public function testPostSearch()
  	{
    		$crawler = $this->client->request('POST', '/api/search.json');
    		$this->assertTrue($this->client->getResponse()->isOk());
  	}

  	public function testWordSearch()
  	{
  	    $data = array(
  	        'word' => 'ランデ',
  	    );
        $crawler = $this->client->request('POST', '/api/search.json', $data);
        
        $jsonResponse = $this->client->getResponse()->getContent();
        $responseData = json_decode($jsonResponse, true);	
  
        $this->assertEquals(count($responseData['snippets']), 1);
    }
  
  	public function testCategorySearch()
  	{
  	    $data = array(
  	        'word' => 'ランディング',
  	        'categories' => array('テンプレート'),
  	    );
        $crawler = $this->client->request('POST', '/api/search.json', $data);
        
        $jsonResponse = $this->client->getResponse()->getContent();
        $responseData = json_decode($jsonResponse, true);	
  
        $this->assertEquals(count($responseData['snippets']), 1);
    }
  
  	public function testNoCategorySearch()
  	{
  	    $data = array(
  	        'word' => 'ランディング',
  	        'categories' => array('テンプレートだ'),
  	    );
        $crawler = $this->client->request('POST', '/api/search.json', $data);
        
        $jsonResponse = $this->client->getResponse()->getContent();
        $responseData = json_decode($jsonResponse, true);	
  
        $this->assertEquals(count($responseData['snippets']), 0);
    }
  
  	public function testTagSearch()
  	{
  	    $data = array(
  	        'word' => '',
  	        'tags' => array('section'),
  	    );
        $crawler = $this->client->request('POST', '/api/search.json', $data);
  
        
        $jsonResponse = $this->client->getResponse()->getContent();
        $responseData = json_decode($jsonResponse, true);	
  
        $this->assertEquals(count($responseData['snippets']), 2);
    }
  
  	public function testNoTagSearch()
  	{
  	    $data = array(
  	        'word' => '',
  	        'tags' => array('sections'),
  	    );
        $crawler = $this->client->request('POST', '/api/search.json', $data);
  
        
        $jsonResponse = $this->client->getResponse()->getContent();
        $responseData = json_decode($jsonResponse, true);	
  
        $this->assertEquals(count($responseData['snippets']), 0);
    }

}
